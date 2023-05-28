@extends('admin.layouts.admin')

@section('title')
    edit room
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش اتاق : {{ $room->name }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.room.update' , ['room' => $room->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-img-bottom">
                    <img class="w-25 h6" src="{{url(env('ROOM_MAIN_PHOTO_PATH').$room->main_photo)}}">
                </div>
                <div class="form-group col-3 mt-3 mb-3">
                    <label for="main_photo">انتخاب تصویر</label>
                    <input class="form-control @error('main_photo') {{'is-invalid'}} @enderror" id="main_photo"
                           name="main_photo" type="file">
                    @error('main_photo') <p class="invalid-feedback"> {{$message}}</p>@enderror
                </div>
                <label for="video_code">پیش نمایش ویدیو </label>

                <div class="card-img-bottom  w-25 h6">
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
                    <input class="form-control @error('video_code') {{'is-invalid'}} @enderror" id="video_code"
                           name="video_code" type="text" value="{{$room->video_code}}">
                    @error('video_code') <p class="invalid-feedback"> {{$message}}</p>@enderror
                </div>
                <hr>


                <div class="row mt-2">
                    <div class="form-group col-3 mt-3">
                        <label for="name">نام</label>
                        <input class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name"
                               type="text" value="{{$room->name}}">
                        @error('name') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="price">قیمت</label>
                        <input class="form-control @error('price') {{'is-invalid'}} @enderror" id="price" name="price"
                               type="text" value="{{$room->price}}">
                        @error('price') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="size">سایز</label>
                        <input class="form-control @error('size') {{'is-invalid'}} @enderror" id="size" name="size"
                               type="text" value="{{$room->size}}">
                        @error('size') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_room">تعداد اتاق </label>
                        <input class="form-control @error('total_room') {{'is-invalid'}} @enderror" id="total_room"
                               name="total_room" type="number" min="1" value="{{$room->total_rooms}}">
                        @error('total_room') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_bathroom">تعداد سرویس بهداشتی </label>
                        <input class="form-control @error('total_bathroom') {{'is-invalid'}} @enderror"
                               id="total_bathroom" name="total_bathroom" type="number" min="1"
                               value="{{$room->total_bathroom}}">
                        @error('total_bathroom') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_guest">تعداد مهمان </label>
                        <input class="form-control @error('total_guest') {{'is-invalid'}} @enderror" id="total_guest"
                               name="total_guest" type="number" min="1" value="{{$room->total_guests}}">
                        @error('total_guest') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_bed">تعداد تخت </label>
                        <input class="form-control @error('total_bed') {{'is-invalid'}} @enderror" id="total_bed"
                               name="total_bed" type="number" min="1" value="{{$room->total_beds}}">
                        @error('total_bed') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-3 mt-3">
                        <label for="total_balcony">تعداد بالکن </label>
                        <input class="form-control @error('total_balcony') {{'is-invalid'}} @enderror"
                               id="total_balcony" name="total_balcony" type="number" min="1"
                               value="{{$room->total_balconies}}">
                        @error('total_balcony') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>

                    <div class="form-group col-3 mt-3">
                        <label for="main_photo">انتخاب تصویر</label>
                        <input class="form-control @error('main_photo') {{'is-invalid'}} @enderror" id="main_photo"
                               name="main_photo" type="file">
                        @error('main_photo') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                </div>
                <div class="form-group  mt-3  fw-bolder">
                    <h5><b> امکانات : </b></h5>
                    <br>
                    @foreach($amenities as $key=>$amenity)
                        <div class="form-check form-check-inline  col-2 border p-2 ">
                            <label class="form-check-label" for="amenity{{$key}}">
                                {{$amenity->name}}
                                <input class="form-check-input" type="checkbox" name="amenity[]"
                                       value="{{$amenity->id}}"
                                       id="amenity{{$key}}" {{in_array($amenity->id,$room->amenities->pluck('id')->toArray()) ? "checked" : ""}} >
                            </label>
                        </div>
                    @endforeach
                    @error('amenity') <p class="invalid-feedback"> {{$message}}</p>@enderror
                </div>
                <div class="form-group  mt-3">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control @error('description') {{'is-invalid'}} @enderror" id="description"
                              name="description" rows="8" cols="12">{{$room->description}}</textarea>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.room.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
