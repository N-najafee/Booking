<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $posts = Cache::remember('adminShowPosts_' . $page, CacheConstant::ONE_DAY, function () {
            return Post::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('admin.post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $imageName = CreateFileName($request->photo->getclientoriginalname());
        $request->photo->move(public_path(env('IMAGE_POST_PATH')), $imageName);
        $data=array_merge($request->validated(),['photo'=>$imageName]);
        Post::create($data);
        // remove cache
        forGetCache('showPosts_');
        forGetCache('blogList_');
        forGetCache('adminShowPosts_');
        return redirect()->route('admin.post.index')->with('message', [
            'type' => "success",
            'body' => ('پست با موفقیت ایجاد گردید')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($request->has('photo')) {
            $imageName = CreateFileName($request->photo->getclientoriginalname());
            unlink(public_path(env('IMAGE_POST_PATH') . $post->photo));
            $request->photo->move(public_path(env('IMAGE_POST_PATH')), $imageName);
        }
        $data=array_merge($request->validated(),['photo'=>$imageName ?? $post->photo]);

        $post->update($data);
        // remove cache
        forGetCache('showPosts_');
        forGetCache('blogList_');
        forGetCache('adminShowPosts_');
        return redirect()->route('admin.post.index')->with('message', [
            'type' => "success",
            'body' => ('پست با موفقیت ویرایش گردید')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        // remove cache
        forGetCache('showPosts_');
        forGetCache('blogList_');
        forGetCache('adminShowPosts_');
        unlink(public_path(env('IMAGE_POST_PATH') . $post->photo));
        return redirect()->route('admin.post.index')->with('message', [
            'type' => "success",
            'body' => ('پست با موفقیت حذف گردید')
        ]);
    }
}
