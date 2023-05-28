@extends('admin.layouts.admin')
@section("title")
    video-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست ویدیو ها </h5>
                <a href="{{route('admin.video.create')}}" class="btn btn-outline-primary">
                    ایجاد ویدیو
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>توضیحات</th>
                    <th>لینک ویدیو</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($videos as $key=>$video)
                    <tr>
                        <td class="text-center">  {{$videos->firstitem() + $key}} </td>
                        <td class="text-center">  {{$video->description}} </td>
                        <td class="text-center ">
                            <style>
                                .h_iframe-aparat_embed_frame{position:relative;}
                                .h_iframe-aparat_embed_frame
                                .ratio{display:block;width:100%;height:auto;}
                                .h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}
                            </style>
                            <div class="h_iframe-aparat_embed_frame">
                                <span style="display: block;padding-top: 57%"></span>
                                <iframe src="https://www.aparat.com/video/video/embed/videohash/{{$video->video_code}}/vt/frame"
                                        allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                            </div>
                        </td>
                        <td class="{{$video->getraworiginal('status')===1 ? "text-success" : "text-danger"}}">  {{$video->status}} </td>

                        <td class="text-center">
                            <div class="row justify-content-center">
                                <div class="d-flex align-items-center justify-content-center ">
                                    <a class="btn btn-outline-info mx-3"
                                   href="{{route('admin.video.edit',['video'=>$video->id])}}">ویرایش</a>
                                <form action="{{route('admin.video.destroy',['video'=>$video->id])}}" method="video">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger me-2">حذف</button>
                                </form>
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
                {{$videos->render()}}
                </div>
            </div>
        </div>
@endsection
