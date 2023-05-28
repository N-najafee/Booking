<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:features,title|string|max:4000',
            'photo' => "required|mimes:jpg,jpeg,png,svg",
            'short_description' => 'required|string|max:200',
            'description' => 'nullable|string|max:4000',
        ]);
        $imageName = CreateFileName($request->photo->getclientoriginalname());
        $request->photo->move(public_path(env('IMAGE_POST_PATH')), $imageName);
        Post::create([
            'title' => $request->title,
            'photo' => $imageName,
            'short_description' => $request->short_description,
            'status' => $request->status,
            'description' => $request->description,
        ]);
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
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|unique:features,title|string|max:4000',
            'photo' => "mimes:jpg,jpeg,png,svg",
            'short_description' => 'required|string|max:200',
            'description' => 'nullable|string|max:4000',
        ]);
        if ($request->has('photo')) {
            $imageName = CreateFileName($request->photo->getclientoriginalname());
            unlink(public_path(env('IMAGE_POST_PATH') . $post->photo));
            $request->photo->move(public_path(env('IMAGE_POST_PATH')), $imageName);
        }
        $post->update([
            'title' => $request->title,
            'photo' => $imageName ?? $post->photo,
            'short_description' => $request->short_description,
            'status' => $request->status,
            'description' => $request->description,
        ]);
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
