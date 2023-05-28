@extends('admin.layouts.admin')
@section("title")
    edit image-room
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row ">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش تصاویر : {{$room['name']}}-{{$room['id']}} </h5>
                <hr>
            </div>
            @include('admin.sections.errors')
            <div class="row">
                <div class="col-3 ">
                    <h5>تصویر اصلی </h5>
                    <div class="card-img">
                        <img class="card-img-top imageCard"
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
                                <form action="{{route('admin.room-photo.destroy',['room'=>$photo['id']])}}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="image_id" value="">
                                    <button type="submit" class="btn btn-outline-danger align-items-center "> حذف
                                    </button>
                                </form>

                                <form action="{{route('admin.room-photo.update',['room'=>$room['id']])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="image_id" value="{{$photo->id}}">
                                    <button type="submit" class="btn btn-outline-info mt-2 ">انتخاب بعنوان تصویر اصلی
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>

            <form action="{{route('admin.room-photo.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{--                    <div class="form-group col-4">--}}
                    {{--                        <label for="primary_image">  تصویر اصلی</label>--}}
                    {{--                        <div class="custom-file">--}}
                    {{--                            <input type="file" class="form-control custom-file-input" name="primary_image" id="primary_image">--}}
                    {{--                            <label class="custom-file-label"></label>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <input type="hidden" name="room_id" value="{{$room['id']}}">
                    <div class="form-group col-4">
                        <label for="images">انتخاب تصاویر</label>
                        <div class="custom-file">
                            <input type="file" class="form-control custom-file-input" name="images[]" multiple
                                   id="images">
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.room.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>

        </div>
    </div>
@endsection
