@extends('admin.layouts.admin')

@section('title')
    show user
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold"> کاربر :{{ $user->name }} </h5>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-3 mt-4">
                    <label for="name">نام</label>
                    <input class="form-control " id="name" name="name" type="text" value="{{$user->name}}" disabled>
                </div>
                <div class="form-group col-md-3 mt-4">
                    <label for="email">ایمیل</label>
                    <input class="form-control " id="email" name="email" type="text" value="{{$user->email}}" disabled>
                </div>
                <div class="form-group col-md-3 mt-4">
                    <label for="phone"> تلفن تماس </label>
                    <input class="form-control " id="phone" name="phone" type="phone" value="{{$user->phone}}" disabled>
                </div>
                <div class="form-group col-md-3 mt-4">
                    <label for="status">وضعیت</label>
                    <input class="form-control " value="{{$user->status}}" disabled>

                </div>
                <div class="form-group col-md-3 mt-4">
                    <label for="roll">نقش کاربر</label>
                    <input class="form-control " value="{{\App\Http\constants\Constants::ROLE_USER[$user->role] }}"
                           disabled>
                </div>
            </div>
            <div class="form-group  mt-3">
                <label for="address">آدرس</label>
                <textarea class="form-control " id="address" name="address" rows="5" cols="12"
                          disabled>{{$user->address}}</textarea>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>

    </div>

@endsection
