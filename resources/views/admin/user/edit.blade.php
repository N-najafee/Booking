@extends('admin.layouts.admin')

@section('title')
    edit edit user
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش کاربر:{{ $user->name }} </h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.user.update' , ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-3 mt-4">
                        <label for="name">نام</label>
                        <input class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name"
                               type="text" value="{{$user->name}}">
                        @error('name') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="email">ایمیل</label>
                        <input class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email"
                               type="text" value="{{$user->email}}">
                        @error('email') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="password">رمز عبور</label>
                        <input class="form-control @error('password') {{'is-invalid'}} @enderror" id="password"
                               name="password" type="password" value="">
                        @error('password') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="phone"> تلفن تماس </label>
                        <input class="form-control @error('phone') {{'is-invalid'}} @enderror" id="phone" name="phone"
                               type="phone" value="{{$user->phone}}">
                        @error('phone') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="status">وضعیت</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" {{$user->getraworiginal('status') ?  "selected" :""}}>فعال</option>
                            <option value="2" {{$user->getraworiginal('status')?  "" :"selected"}}>غیرفعال</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 mt-4">
                        <label for="roll">نقش کاربر</label>
                        <select class="form-control" name="roll" id="roll">
                            @foreach(\App\Http\constants\Constants::ROLE_USER as $key=>$role)
                                <option value="{{$key}}" {{$user->role === $key ? "selected" : ""}}>{{$role}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group  mt-3">
                    <label for="address">آدرس</label>
                    <textarea class="form-control @error('address') {{'is-invalid'}} @enderror" id="address"
                              name="address" rows="5" cols="12">{{$user->address}}</textarea>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
