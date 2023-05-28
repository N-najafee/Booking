@extends('admin.layouts.admin')
@section("title")
    create_feature
@endsection
@section('content')

    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد ویژگی</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.feature.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3 mt-4">
                        <label for="title">عنوان</label>
                        <input class="form-control @error('title') {{'is-invalid'}} @enderror" id="title" name="title" type="text" value="{{old('title')}}">
                      @error('title')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>

                    <div class="form-group col-md-3 mt-4">
                        <label for="icon">ایکون</label>
                        <input class="form-control @error('icon') {{'is-invalid'}} @enderror" id="icon" name="icon" type="text" value="{{old('icon')}}">
                   @error('icon')<p class="invalid-feedback">{{$message}}</p>@enderror
                    </div>
        </div>
                <div class="form-group mt-4 ">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control @error('description') {{'is-invalid'}} @enderror" id="description" name="description" rows="3" cols="12">{{old('description')}}</textarea>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.feature.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection

