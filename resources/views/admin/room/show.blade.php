@extends('admin.layouts.admin')

@section('title')
    show room
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش اتاق : {{ $room->name }}</h5>
            </div>
            <hr>
                <label for="video_code">پیش نمایش ویدیو </label>

                <div   class="card-img-bottom  w-25 h6">
                    <style>.h_iframe-aparat_embed_frame {
                            position: relative;
                        }

                        .h_iframe-aparat_embed_frame .ratio {
                            display: block;
                            width: 100%;
                            height: auto;
                        }

                        .h_iframe-aparat_embed_frame iframe {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }</style>
                    <div class="h_iframe-aparat_embed_frame">
                        <span style="display: block;padding-top: 57%"></span>
                        <iframe
                            src="https://www.aparat.com/video/video/embed/videohash/{{$room->video_code}}/vt/frame"
                            allowFullScreen="true" webkitallowfullscreen="true"
                            mozallowfullscreen="true"></iframe>
                    </div>
                </div>
                <div class="form-group col-3 mt-3">
                    <label for="video_code">کد ویدیو در آپارات</label>
                    <input class="form-control " id="video_code" name="video_code" type="text" value="{{$room->video_code}}" disabled>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="form-group col-3 mt-3">
                        <label for="name">نام</label>
                        <input class="form-control " id="name" name="name" type="text" value="{{$room->name}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="price">قیمت</label>
                        <input class="form-control" id="price" name="price" type="text" value="{{$room->price}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="size">سایز</label>
                        <input class="form-control " id="size" name="size" type="text" value="{{$room->size}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_room">تعداد اتاق </label>
                        <input class="form-control " id="total_room" name="total_room" type="text" min="1" value="{{$room->total_rooms}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_bathroom">تعداد سرویس بهداشتی </label>
                        <input class="form-control " id="total_bathroom" name="total_bathroom" type="text" min="1" value="{{$room->total_bathroom}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_guest">تعداد مهمان </label>
                        <input class="form-control " id="total_guest" name="total_guest" type="text" min="1" value="{{$room->total_guests}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_bed">تعداد تخت </label>
                        <input class="form-control " id="total_bed" name="total_bed" type="text" min="1" value="{{$room->total_beds}}" disabled>
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_balconies">تعداد بالکن </label>
                        <input class="form-control" id="total_balconies" name="total_balconies" type="text" value="{{$room->total_balconies}}" disabled>
                    </div>
                </div>
            <h4 class="mt-3">   امکانات : </h4>
            <div class="form-group col-3 mt-3 d-flex">

                            @foreach($room->amenities as $amenity)
                                <div class="col-6 ">
                                    <div class="mb-4 me-2 p-2 bg-aliceblue ">
                                        <p class="fs-5"><i class="fa fa-check-circle"></i> {{$amenity->name}}</p>
                                    </div>
                                </div>
                            @endforeach
                </div>
                <div class="form-group  mt-3">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control " id="description" name="description" rows="8" cols="12" disabled>{{$room->description}}</textarea>
                </div>

            <div class="row mt-5">
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.room.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>

        </div>
    </div>

@endsection
