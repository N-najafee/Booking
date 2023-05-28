<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomPhotoStoreRequest;
use App\Models\Room;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RoomPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomPhotoStoreRequest $request)
    {
        $room = Room::find($request->room_id);
        $imageNames = [];
        foreach ($request->images as $image) {
            $photoName = CreateFileName($image->getclientOriginalname());
            $image->move(public_path(env('ROOM_OTHER_PHOTO_PATH')), $photoName);
            $imageNames[] = ['photo' => $photoName];
        }
        $room->roomPhotos()->createMany($imageNames);
        return redirect()->back()->with('message', [
            'type' => "success",
            'body' => ('تصاویر با موفقیت ایجاد گردید')
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('admin.room.show-image', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::where('id', $id)->with('roomPhotos')->first();
        return view('admin.room.edit-images', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $roomPhoto = RoomPhoto::find($request->roomPhotoId);
        $result = File::move(public_path(env('ROOM_OTHER_PHOTO_PATH') . $roomPhoto->photo),
            public_path(env('ROOM_MAIN_PHOTO_PATH') . $roomPhoto->photo));
        if ($result) {
            unlink(public_path(env('ROOM_MAIN_PHOTO_PATH') . $room->main_photo));
            $room->update([
                'main_photo' => $roomPhoto->photo
            ]);
            $roomPhoto->delete();
            // remove cache
            forGetCache('showRooms_');
            forGetCache('roomList_');
            forGetCache('adminShowRooms_');
            return redirect()->back()->with('message', [
                'type' => "success",
                'body' => (' تصویر اصلی با موفقیت ویرایش گردید')
            ]);
        }
        return redirect()->back()->with('message', [
            'type' => "danger",
            'body' => ('تغییر تصویر اصلی انجام نشد')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roomPhoto = RoomPhoto::find($id);
        if (file_exists(public_path(env('ROOM_OTHER_PHOTO_PATH') . $roomPhoto->photo))) {
            unlink(public_path(env('ROOM_OTHER_PHOTO_PATH') . $roomPhoto->photo));
        }
        $roomPhoto->delete();
        // remove cache
        forGetCache('showRooms_');
        forGetCache('roomList_');
        forGetCache('adminShowRooms_');
        return redirect()->back()->with('message', [
            'type' => "success",
            'body' => ('تصویر با موفقیت حذف گردید')
        ]);

    }
}
