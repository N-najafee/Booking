<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $amenities = Cache::remember('adminShowAmenity_' . $page, CacheConstant::ONE_DAY, function () {
            return Amenity::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('admin.amenity.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenity.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:500',
        ]);
        Amenity::create([
            'name' => $request->name,
        ]);
        // remove cache
        forGetCache('adminShowAmenity_');
        return redirect()->route('admin.amenity.index')->with('message', [
            'type' => "success",
            'body' => ('امکانات رفاهی با موفقیت ایجاد گردید')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        return view('admin.amenity.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenity $amenity)
    {
        $request->validate([
            'name' => 'required|string|max:500',
        ]);
        $amenity->update([
            'name' => $request->name,
        ]);
        // remove cache
        forGetCache('adminShowAmenity_');
        return redirect()->route('admin.amenity.index')->with('message', [
            'type' => "success",
            'body' => ('امکانات رفاهی با موفقیت ویرایش گردید')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        $amenity->delete();
        // remove cache
        forGetCache('adminShowAmenity_');
        return redirect()->back()->with('message', [
            'type' => 'warning',
            'body' => "امکانات رفاهی انتخاب شده حذف گردید"
        ]);
    }
}
