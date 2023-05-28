@extends('admin.layouts.admin')

@section('title')
    edit post
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش پست : {{ $post->title }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.post.update' , ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                    <div   class="card-img-bottom">
                        <img class="w-25 h6" src="{{url(env('IMAGE_POST_PATH').$post->photo)}}">
                    </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-3 mt-4">
                        <label for="photo">انتخاب تصویر</label>
                        <input class="form-control @error('photo') {{'is-invalid'}} @enderror" id="photo" name="photo" type="file">
                        @error('photo')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="title">عنوان</label>
                        <input class="form-control @error('title') {{'is-invalid'}} @enderror" id="title" name="title" type="text" value="{{$post->title}}">
                        @error('title')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="status">وضعیت</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" {{$post->getraworiginal('status') ===1 ?  "selected" :""}} >فعال</option>
                            <option value="2" {{$post->getraworiginal('status')===1 ? "" : "selected" }}>غیرفعال</option>
                        </select>
                    </div>
                </div>
                <div class="form-group  mt-4">
                    <label for="short_description">توضیحات کوتاه</label>
                    <textarea class="form-control sli-notebook @error('short_description') {{'is-invalid'}} @enderror" id="short_description" name="short_description"  rows="3" cols="12">{{$post->short_description}}</textarea>
                    @error('short_description')<p class="invalid-feedback">{{$message}}</p>@enderror
                </div>
                <div class="form-group mt-3" >
                    <label for="description">توضیحات</label>
                    <textarea class="form-control @error('description') {{'is-invalid'}} @enderror" id="description" name="description" rows="8" cols="12">{{$post->description}}</textarea>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.post.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
