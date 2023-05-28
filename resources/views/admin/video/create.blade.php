@extends('admin.layouts.admin')
@section("title")
    create_video
@endsection
@section('content')

    <!-- description Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد ویدیو</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3 mt-4">
                        <label for="video_code">کد ویدیو در آپارات</label>
                        <input class="form-control @error('video_code') {{'is-invalid'}} @enderror" id="video_code" name="video_code" type="text" value="{{old('video_code')}}">
                      @error('video_code')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="status">وضعیت</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" selected>فعال</option>
                            <option value="2">غیرفعال</option>
                        </select>
                    </div>
        </div>
                <div class="form-group mt-4">
                    <label for="description">توضیحات کوتاه</label>
                    <textarea class="form-control sli-notebook @error('description') {{'is-invalid'}} @enderror" id="description" name="description"  rows="3" cols="12">{{old('description')}}</textarea>
                    @error('description')<p class="invalid-feedback">{{$message}}</p>@enderror
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.video.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection

