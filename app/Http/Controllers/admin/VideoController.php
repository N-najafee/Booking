<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoStoreRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page=$request->page ?? 0;
        $videos =Cache::remember('adminShowVideo_'.$page,CacheConstant::ONE_DAY,function (){
          return  Video::latest()->paginate(Constants::PAGINATION_DEFAULT);
        })  ;

        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoStoreRequest $request)
    {
        $data=$request->validated();
        Video::create($data);
        // remove cache
        forGetCache('adminShowVideo_');
        forGetCache('galleryList_');
        return redirect()->route('admin.video.index')->with('message', [
            'type' => "success",
            'body' => ('ویدیو با موفقیت ایجاد گردید')
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Video $video
     * @return \Illuminate\Http\Response
     */
    public function update(VideoUpdateRequest $request, Video $video)
    {
        $data=$request->validated();
        $video->update($data);
        // remove cache
        forGetCache('adminShowVideo_');
        forGetCache('galleryList_');
        return redirect()->route('admin.video.index')->with('message', [
            'type' => "success",
            'body' => ('ویدیو با موفقیت ویرایش گردید')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Video $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        // remove cache
        forGetCache('adminShowVideo_');
        forGetCache('galleryList_');
        return redirect()->route('admin.video.index')->with('message', [
            'type' => "success",
            'body' => ('ویدیو با موفقیت جذف گردید')
        ]);
    }
}
