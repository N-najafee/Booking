@extends('admin.layouts.admin')
@section('title')
    show post
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش پست : {{ $post->title }}</h5>
            </div>
            <hr>
            <div class="card-img-bottom">
                <img class="w-25 h6" src="{{url(env('IMAGE_POST_PATH').$post->photo)}}">
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-3 mt-4">
                    <label for="title">عنوان</label>
                    <input class="form-control" id="title" name="title" type="text" value="{{$post->title}}" disabled>
                </div>
                <div class="form-group col-md-3 mt-4">
                    <label for="status">وضعیت</label>
                    <input class="form-control " id="photo" name="photo" value="{{$post->status}}" type="text" disabled>

                </div>
                <div class="form-group col-md-3 mt-4">
                    <label>تعداد بازدید</label>
                    <input class="form-control " id="photo" name="photo" value="{{$post->total_view}}" type="text"
                           disabled>
                </div>
            </div>
            <div class="form-group  mt-4">
                <label for="short_description">توضیحات کوتاه</label>
                <textarea class="form-control sli-notebook " id="short_description" name="short_description" disabled
                          rows="3" cols="12">{{$post->short_description}}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="description">توضیحات</label>
                <textarea class="form-control " id="description" name="description" disabled rows="8"
                          cols="12">{{$post->description}}</textarea>
            </div>
            <a href="{{ route('admin.post.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>
@endsection
