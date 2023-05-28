@extends('home.layout.home')

@section('title')
    edit  user profile
@endsection

@section('content')

    <div class="container-fluid  bg-success  bg-opacity-50 p-3 align-items-center justify-content-center ">
        <div class="p-3 text-center">
            <h1 class="">{{$user->name}} </h1>
            <p class="lead">حساب کاربری</p>
        </div>
    </div>

    <div class="container-fluid p-5 ">
        <div class="row">

            <div class="col-4 p-2">
                <div class="card p-3 " style="width: 25rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item btn btn-outline-success ">پروفایل</li>
                        <li class="list-group-item btn btn-outline-success ">  <a  href="{{route('profile.index')}}"> لیست رزرو </a></li>
                        <li class="list-group-item btn btn-outline-success ">نظرات</li>
                        <li class="list-group-item btn btn-outline-danger ">خروج</li>
                    </ul>

                </div>
            </div>
            <div class="col-8  border  p-5">
                <div class="mb-4">
                    <h5 class="font-weight-bold">ویرایش پروفایل:{{ $user->name }} </h5>
                </div>
                <hr>
                @include('home.sections.message')
                <form action="{{ route('profile.update' , ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-3 mt-4">
                            <label for="name">نام</label>
                            <input class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" type="text" value="{{$user->name}}">
                            @error('name')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-md-3 mt-4">
                            <label for="email">ایمیل</label>
                            <input class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email" type="text" value="{{$user->email}}">
                            @error('email')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-md-3 mt-4">
                            <label for="password"> رمز عبور جدید </label>
                            <input class="form-control @error('password') {{'is-invalid'}} @enderror" id="password" name="password" type="password" >
                            @error('password')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-md-3 mt-4">
                            <label for="phone"> تلفن تماس </label>
                            <input class="form-control @error('phone') {{'is-invalid'}} @enderror" id="phone" name="phone" type="phone" value="{{$user->phone}}" >
                            @error('phone')  <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                    </div>
                    <div class="form-group  mt-3">
                        <label for="address">آدرس</label>
                        <textarea class="form-control @error('address') {{'is-invalid'}} @enderror" id="address" name="address" rows="5" cols="12">{{$user->address}}</textarea>

                    </div>
                    <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                </form>
            </div>

        </div>
    </div>

    <!-- Content Row -->
{{--    <div class="row ">--}}
{{--        <div class="col-6 col-md-12 mb-4 p-md-5 bg-white">--}}
{{--            <div class="mb-4">--}}
{{--                <h5 class="font-weight-bold">ویرایش پروفایل:{{ $user->name }} </h5>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--            @include('home.sections.message')--}}
{{--            <form action="{{ route('profile.update' , ['user' => $user->id]) }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}
{{--                <div class="row">--}}
{{--                    <div class="form-group col-md-3 mt-4">--}}
{{--                        <label for="name">نام</label>--}}
{{--                        <input class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" type="text" value="{{$user->name}}">--}}
{{--                        @error('name')  <p class="invalid-feedback"> {{$message}}</p>@enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-md-3 mt-4">--}}
{{--                        <label for="email">ایمیل</label>--}}
{{--                        <input class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email" type="text" value="{{$user->email}}">--}}
{{--                        @error('email')  <p class="invalid-feedback"> {{$message}}</p>@enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-md-3 mt-4">--}}
{{--                        <label for="password"> رمز عبور جدید </label>--}}
{{--                        <input class="form-control @error('password') {{'is-invalid'}} @enderror" id="password" name="password" type="password" >--}}
{{--                        @error('password')  <p class="invalid-feedback"> {{$message}}</p>@enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-md-3 mt-4">--}}
{{--                        <label for="phone"> تلفن تماس </label>--}}
{{--                        <input class="form-control @error('phone') {{'is-invalid'}} @enderror" id="phone" name="phone" type="phone" value="{{$user->phone}}" >--}}
{{--                        @error('phone')  <p class="invalid-feedback"> {{$message}}</p>@enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group  mt-3">--}}
{{--                    <label for="address">آدرس</label>--}}
{{--                    <textarea class="form-control @error('address') {{'is-invalid'}} @enderror" id="address" name="address" rows="5" cols="12">{{$user->address}}</textarea>--}}

{{--                </div>--}}
{{--                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>--}}
{{--                <a href="{{ route('hotel') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>--}}
{{--            </form>--}}
{{--        </div>--}}

{{--    </div>--}}

@endsection
