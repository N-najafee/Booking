@extends('admin.layouts.admin')
@section("title")
    create_room
@endsection
@section('content')

    <!-- description Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد اتاق</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.room.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2">
                    <div class="form-group col-4 mt-3">
                        <label for="name">نام</label>
                        <input class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" type="text" value="{{old('name')}}">
                      @error('name')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="price">قیمت</label>
                        <input class="form-control @error('price') {{'is-invalid'}} @enderror" id="price" name="price" type="text" value="{{old('price')}}">
                        @error('price')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="size">سایز</label>
                        <input class="form-control @error('size') {{'is-invalid'}} @enderror" id="size" name="size" type="text" value="{{old('size')}}">
                        @error('size')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="video_code">کد ویدیو در آپارات</label>
                        <input class="form-control @error('video_code') {{'is-invalid'}} @enderror" id="video_code" name="video_code" type="text" value="{{old('video_code')}}">
                        @error('video_code')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="total_rooms">تعداد اتاق </label>
                        <input class="form-control @error('total_rooms') {{'is-invalid'}} @enderror" id="total_rooms" name="total_rooms" type="number" min="1" value="{{old('total_rooms')}}">
                        @error('total_rooms')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="total_bathroom">تعداد سرویس بهداشتی </label>
                        <input class="form-control @error('total_bathroom') {{'is-invalid'}} @enderror" id="total_bathroom" name="total_bathroom" type="number" min="1" value="{{old('total_bathroom')}}">
                        @error('total_bathroom')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="total_guests">تعداد مهمان </label>
                        <input class="form-control @error('total_guests') {{'is-invalid'}} @enderror" id="total_guests" name="total_guests" type="number" min="1" value="{{old('total_guests')}}">
                        @error('total_guests')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="total_beds">تعداد تخت </label>
                        <input class="form-control @error('total_beds') {{'is-invalid'}} @enderror" id="total_beds" name="total_beds" type="number" min="1" value="{{old('total_beds')}}">
                        @error('total_beds')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="total_balconies">تعداد بالکن </label>
                        <input class="form-control @error('total_balconies') {{'is-invalid'}} @enderror" id="total_balconies" name="total_balconies" type="number" min="1" value="{{old('total_balconies')}}">
                        @error('total_balconies')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
        </div>
                <hr>
                <h5>  <b> انتخاب تصاویر :</b></h5>
                <div class="row">
                    <div class="form-group col-4 mt-3">
                        <label for="main_photo">انتخاب تصویر اصلی </label>
                        <input class="form-control @error('main_photo') {{'is-invalid'}} @enderror" id="main_photo" name="main_photo" type="file">
                        @error('main_photo')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-4 mt-3">
                        <label for="images">انتخاب سایر تصاویر</label>
                        <input class="form-control @error('images') {{'is-invalid'}} @enderror" id="images" name="images[]" type="file" multiple>
                        @error('images')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                </div>

                <hr>
                <div class="form-group  mt-3  fw-bolder">
                    <h5><b> امکانات : </b></h5>
                    <br>
                    @foreach($amenities as $key=>$amenity)
                        <div class="form-check form-check-inline  col-2 border p-2 ">
                            <label class="form-check-label" for="amenity{{$key}}">
                                {{$amenity->name}}

                            <input class="form-check-input " type="checkbox" name="amenity[]" value="{{$amenity->id}}" id="amenity{{$key}}">
                            </label>
                            </div>

                    @endforeach
                    @error('amenity')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                </div>


                <div class="form-group  mt-3">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control @error('description') {{'is-invalid'}} @enderror" id="description" name="description" rows="8" cols="12">{{old('description')}}</textarea>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.room.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection

