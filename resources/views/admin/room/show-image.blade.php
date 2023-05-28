@extends('admin.layouts.admin')

@section('title')
    show-room_image
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش تصاویر اتاق : {{ $room->name }}</h5>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-3 ">
                    <h5>تصویر اصلی </h5>
                    <div class="card-img">
                        <img class="card-img image15"
                             src="{{url(env('ROOM_MAIN_PHOTO_PATH').$room['main_photo'])}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    <h5>سایر تصاویر </h5>
                </div>
                @foreach($room->roomPhotos as $photo)
                    <div class="col-3 mt-3">
                        <div class="card">
                            <img class=" image15"
                                 src="{{url(env('ROOM_OTHER_PHOTO_PATH').$photo['photo'])}}">
                            <div class="card-body  text-center mt-3">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.room.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>

@endsection
