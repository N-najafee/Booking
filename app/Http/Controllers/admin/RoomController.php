<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Amenity;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $rooms = Cache::remember('adminShowRooms_' . $page, CacheConstant::ONE_DAY, function () {
            return Room::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('admin.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenity::all();
        return view('admin.room.create', compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        try {
            DB::beginTransaction();
            $photoName = CreateFileName($request->main_photo->getclientOriginalname());
            $request->main_photo->move(public_path(env('ROOM_MAIN_PHOTO_PATH')), $photoName);
            $room = Room::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'size' => $request->size,
                'total_rooms' => $request->total_room,
                'total_bathroom' => $request->total_bathroom,
                'total_balconies' => $request->total_balcony,
                'total_guests' => $request->total_puest,
                'total_beds' => $request->total_bed,
                'main_photo' => $photoName,
            ]);

            foreach ($request->images as $image) {
                $photoName = CreateFileName($image->getclientOriginalname());
                $image->move(public_path(env('ROOM_OTHER_PHOTO_PATH')), $photoName);
                $room->roomPhotos()->create([
                    'photo' => $photoName
                ]);
            }
            $room->amenities()->attach($request->amenity);
            // remove cache
            forGetCache('showRooms_');
            forGetCache('roomList_');
            forGetCache('adminShowRooms_');
            DB::commit();
            return redirect()->route('admin.room.index')->with('message', [
                'type' => "success",
                'body' => ('اتاق با موفقیت ایجاد گردید')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            unlink(public_path(env('ROOM_MAIN_PHOTO_PATH') . $photoName));
            return redirect()->back()->with('message', [
                'type' => "danger",
                'body' => $e->getMessage()
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('admin.room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $amenities = Amenity::all();
        return view('admin.room.edit', compact('room'), compact('amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        try {
            DB::beginTransaction();
            if ($request->has('main_photo')) {
                $photoName = CreateFileName($request->main_photo->getclientOriginalname());
                unlink(public_path(env('ROOM_MAIN_PHOTO_PATH') . $room->main_photo));
                $request->main_photo->move(public_path(env('ROOM_MAIN_PHOTO_PATH')), $photoName);
            }

            $room->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'size' => $request->size,
                'total_rooms' => $request->total_room,
                'total_bathroom' => $request->total_bathroom,
                'total_balconies' => $request->total_balcony,
                'total_guests' => $request->total_guest,
                'total_beds' => $request->total_bed,
                'video_code' => $request->video_code,
                'main_photo' => $photoName ?? $room->main_photo,
            ]);
            $room->amenities()->sync($request->amenity);
            // remove cache
            forGetCache('showRooms_');
            forGetCache('roomList_');
            forGetCache('adminShowRooms_');
            DB::commit();
            return redirect()->route('admin.room.index')->with('message', [
                'type' => "success",
                'body' => ('اتاق با موفقیت ویرایش گردید')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', [
                'type' => "danger",
                'body' => $e->getMessage()
            ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        try {
            DB::beginTransaction();
            $room->delete();
            if (file_exists(public_path(env('ROOM_MAIN_PHOTO_PATH') . $room->main_photo))) {
                unlink(public_path(env('ROOM_MAIN_PHOTO_PATH') . $room->main_photo));
            }
            foreach ($room->roomPhotos as $photo) {
                if (file_exists(public_path(env('ROOM_OTHER_PHOTO_PATH') . $photo->photo))) {
                    unlink(public_path(env('ROOM_OTHER_PHOTO_PATH') . $photo->photo));
                }
            }
            $room->roomPhotos()->delete();
            $amenity = $room->amenities;
            $room->amenities()->detach($amenity);
            // remove cache
            forGetCache('showRooms_');
            forGetCache('roomList_');
            forGetCache('adminShowRooms_');
            DB::commit();
            return redirect()->route('admin.room.index')->with('message', [
                'type' => "success",
                'body' => ('اتاق با موفقیت حذف گردید')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', [
                'type' => "danger",
                'body' => $e->getMessage()
            ]);
        }
    }
}
