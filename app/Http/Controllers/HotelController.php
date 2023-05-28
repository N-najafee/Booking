<?php

namespace App\Http\Controllers;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Room;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HotelController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $features = Cache::remember('showFeatures_' . $page, CacheConstant::ONE_DAY, function () {
            return Feature::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });

        $posts = Cache::remember('showPosts_' . $page, CacheConstant::ONE_DAY, function () {
            return Post::where('status', Constants::POST_ACTIVE)->latest()->paginate(Constants::PAGINATION_CUSTOM);
        });

        $rooms = Cache::remember('showRooms_' . $page, CacheConstant::ONE_DAY, function () {
            return Room::orderBy('created_at', "desc")->latest()->paginate(Constants::PAGINATION_CUSTOM);
        });
        $allRoom = Room::orderBy('created_at', "desc")->get();
        return view('home.index', compact('features', 'posts', 'rooms', 'allRoom'));
    }

    public function blog_list()
    {
        $page = request()->get('page') ?? 0;
        $posts = Cache::remember('blogList_' . $page, CacheConstant::ONE_DAY, function () {
            return Post::orderBy('created_at', "desc")->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('home.blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function blog_show(Post $post)
    {
        $post->increment('total_view');
        return view('home.blog.show', compact('post'));
    }

    public function gallery()
    {
        $page = request()->get('page') ?? 0;
        $videos = Cache::remember('galleryList_' . $page, CacheConstant::ONE_DAY, function () {
            return Video::orderBy('created_at', "desc")->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('home.gallery', compact('videos'));
    }


    public function room_list()
    {
        $page = request()->get('page') ?? 0;
        $rooms = Cache::remember('roomList_' . $page, CacheConstant::ONE_DAY, function () {
            return Room::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('home.room.index', compact('rooms'));
    }

    public function room_detail($id)
    {
        $room = Room::with(['amenities', 'roomPhotos', 'comments' => function ($q) {
            return $q->where('status', Constants::COMMENT_VERIFIED);
        }])->where('id', $id)->first();
        return view('home.room.detail', compact('room'));
    }

    public function load_more(Request $request)
    {
        $page = $request->page ?? 0;
        $posts = Post::orderBy('created_at', 'desc')
            ->offset(($page - 1) * Constants::PAGINATION_CUSTOM)
            ->limit(Constants::PAGINATION_DEFAULT)
            ->get();
        if ($posts->isEmpty()) {
            return response()->json(['message' => 'No more posts'], 204);
        }
        return response()->json($posts, 200);
    }
}
