@extends('admin.layouts.admin')
@section("title")
    comment-index
@endsection
@section('content')

    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست نظرات </h5>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر ایجاد کننده</th>
                    <th>نام اتاق</th>
                    <th>وضعیت</th>
                    <th>متن نظر</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $key=>$comment)
                    <tr>
                        <td>  {{$comments->firstitem() + $key}} </td>
                        <td>  {{$comment->user->name}} </td>
                        <td>  {{$comment->room->name}} </td>
                        <td class="{{$comment->getraworiginal('status')===\App\Http\constants\Constants::COMMENT_VERIFIED ? "text-success" : "text-danger"}}">  {{$comment->status}} </td>
                        <td>  {{$comment->comment}} </td>
                        <td>
                            <div class="text-center text-danger d-flex justify-content-center">
                                <form action="{{route('admin.comment.update',['comment'=>$comment->id])}}"
                                      method="post">
                                    @csrf
                                    @method('PUT')
                                    <button
                                        class="ms-3 {{$comment->getraworiginal('status') === \App\Http\constants\Constants::COMMENT_VERIFIED ? "btn btn-outline-info" : "btn btn-outline-success"}}"
                                        type="submit">
                                        {{$comment->getraworiginal('status') === \App\Http\constants\Constants::COMMENT_VERIFIED ?  "لغو تایید" : "تایید" }}
                                    </button>

                                </form>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger " data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop-{{$comment->id}}">
                                    حذف
                                </button>
                                <!-- Modal -->
                                <div class="modal " id="staticBackdrop-{{$comment->id}}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content w-100">
                                            <div class="modal-body text-dark fs-5">
                                                ایا از حذف این آیتم مطمئن هستید؟
                                            </div>

                                            <div class="modal-footer justify-content-start">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    بستن
                                                </button>
                                                <form
                                                    action="{{route('admin.comment.destroy',['comment'=>$comment->id])}}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" value="حذف">حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-5 col-12">
            <div class="row justify-content-center p-5">
                <div class="col-4">
                    {{$comments->render()}}
                </div>
            </div>
        </div>
@endsection

