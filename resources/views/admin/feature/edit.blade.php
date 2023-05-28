@extends('admin.layouts.admin')

@section('title')
    edit feature
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش ویژگی : {{ $feature->title }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.feature.update' , ['feature' => $feature->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-3 mt-4">
                        <label for="title">نام</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ $feature->title }}">
                    </div>

                    <div class="form-group col-md-3 mt-4">
                        <label for="icon">آیکون</label>
                        <input class="form-control" id="icon" name="icon" type="text" value="{{ $feature->icon}}">
                    </div>
                </div>
                <div class="form-group mt-4">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control " id="description" name="description" rows="3" cols="12">{{$feature->description}}</textarea>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.feature.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
