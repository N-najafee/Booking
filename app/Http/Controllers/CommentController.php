<?php

namespace App\Http\Controllers;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = \request()->page ?? 0;
        $comments = cache()->remember('adminComment_'.$page,CacheConstant::ONE_DAY,function () {
           return Comment::with('user', 'room')->latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('admin.comment.index', compact('comments'));
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|min:5|max:4000',
            'room_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#comment')->withErrors($validator);
        }

        $user = User::with(['roomDetails', 'orders'])->where('id', auth()->id())->first();
        $roomIds = $user->roomDetails->pluck('room_id')->toArray();
        if ($user->orders->isNotEmpty() && in_array($request->room_id, $roomIds)) {
            $user->comments()->create([
                'room_id' => $request->room_id,
                'comment' => $request->comment,
            ]);
            forGetCache('adminComment_');
            return redirect()->to(url()->previous() . '#comment')->with('message', [
                'type' => 'success',
                'body' => "دیدگاه شما با موفقیت ثبت گردید و پس از تایید نمایش داده خواهد شد"
            ]);
        } else {
            return redirect()->to(url()->previous() . '#comment')->with('message', [
                'type' => 'danger',
                'body' => "کاربر گرامی این اتاق در لیست رزرو شما نبوده و نمی توانید دیدگاهی بابت آن ثبت نمایید"
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->getraworiginal('status') ?
            $comment->update(['status' => Constants::COMMENT_UNVERIFIED]) :
            $comment->update(['status' => Constants::COMMENT_VERIFIED]);

        $status = $comment->getraworiginal('status') ? "تایید" : "لغو تایید";
        forGetCache('adminComment_');
        return redirect()->back()->with('message', [
            'type' => 'success',
            'body' => " دیدگاه با موفقیت $status شد. "
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        forGetCache('adminComment_');
        return redirect()->back()->with('message', [
            'type' => 'success',
            'body' => 'دیدگاه با موفقیت حذف گردید.'
        ]);
    }
}
