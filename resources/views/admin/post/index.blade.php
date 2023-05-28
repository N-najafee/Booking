@extends('admin.layouts.admin')
@section("title")
    feature-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست پست ها </h5>
                <a href="{{route('admin.post.create')}}" class="btn btn-outline-primary">
                    ایجاد پست
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>توضیحات کوتاه</th>
                    <th>لینک عکس</th>
                    <td>وضعیت</td>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $key=>$post)
                    <tr>
                        <td class="text-center p-5">  {{$posts->firstitem() + $key}} </td>
                        <td class="text-center p-5">  {{$post->title}} </td>
                        <td class="text-center wrapper p-5">  {{$post->short_description}} </td>
                        <td class="text-center ">
                            <a href="{{url((env('IMAGE_POST_PATH').$post->photo))}}" alt="image" target="_blank">
                                <img src="{{url(env('IMAGE_POST_PATH').$post->photo)}}" alt="image"
                                     class="card-img " style="width:100%; height: 100px">
                            </a>
                        </td>
                        <td class="{{$post->getraworiginal('status')===1 ? "text-success" : "text-danger"}} p-5">  {{$post->status}} </td>

                        <td class="text-center p-5">
                            <div class="row justify-content-center">
                                <div class="d-flex align-items-center justify-content-center ">
                                    <a class="btn btn-outline-info mx-3"
                                       href="{{route('admin.post.edit',['post'=>$post->id])}}">ویرایش</a>
                                    <a class="btn btn-outline-primary mx-3"
                                       href="{{route('admin.post.show',['post'=>$post->id])}}">نمایش</a>
                                    <form action="{{route('admin.post.destroy',['post'=>$post->id])}}" method="post">
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
                    {{$posts->render()}}
                </div>
            </div>
        </div>
@endsection

