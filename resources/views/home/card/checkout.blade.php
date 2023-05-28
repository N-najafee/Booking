@extends('home.layout.home')
@section("title")
    <p>room-checkout</p>
@endsection

@section('content')
    <div class="container-fluid  bg-success  bg-opacity-50 p-3 align-items-center justify-content-center ">
        <div class="p-3 text-center">
            <h1 class="">صورتحساب </h1>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row ">
            <h2 class=" p-3">اطلاعات صورتحساب </h2>
            @include('home.sections.message')
            <div class="col-8 fs-6 p-3">
                <form action="{{route('profile.update',['user'=>auth()->id()])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row ">
                        <div class="form-group  col-md-4 mt-4">
                            <label for="name">نام</label>
                            <input class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name"
                                   type="text" value="{{auth()->user()->name}}">
                            @error('name') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-md-4 mt-4">
                            <label for="email">ایمیل</label>
                            <input class="form-control @error('email') {{'is-invalid'}} @enderror" id="email"
                                   name="email" type="text" value="{{auth()->user()->email}}">
                            @error('email') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-md-4 mt-4">
                            <label for="phone"> تلفن تماس </label>
                            <input class="form-control @error('phone') {{'is-invalid'}} @enderror" id="phone"
                                   name="phone" type="phone" value="{{auth()->user()->phone}}">
                            @error('phone') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                    </div>
                    <div class="form-group  mt-3">
                        <label for="address">آدرس</label>
                        <textarea class="form-control @error('address') {{'is-invalid'}} @enderror" id="address"
                                  name="address" rows="5" cols="12">{{auth()->user()->address}}</textarea>
                        @error('address') <p class="invalid-feedback"> {{$message}}</p>@enderror
                    </div>
                    <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                </form>
            </div>
            <div class="col-4 pt-5">
                <div class="card text-dark bg-gray mb-4 fw-bolder " style="max-width: 30rem;">
                    <div class="card-body ">
                        <h5 class="card-header fw-bolder">جزییات رزرو </h5>
                        @php  $total=0 @endphp
                        @foreach($reserves as $reserve)
                            @php       $total+=$reserve['subtotal'] @endphp

                            <li class="card-body">     {{$reserve['name']}}   </li>
                            <p class="card-title"> هزینه هر شب اقامت : {{number_format($reserve['price'])}} ﷼ </p>
                            <p class="card-title"> تاریخ ورود : {{$reserve['check_in']}}</p>
                            <p class="card-title"> تاریخ خروج : {{$reserve['check_out']}}</p>
                            <p class="card-title"> بزرگسال : {{$reserve['adult']}} , کودک
                                : {{$reserve['children']}} </p>
                            <p class="card-title"> جمع : {{number_format( $reserve['subtotal'])}} ﷼ </p>
                        @endforeach
                    </div>
                    <form action="{{route('paymentCreate.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="user" value="{{auth()->id()}}">
                        <input type="hidden" name="total" value="{{$total}}">
                        <div class="card-footer">
                            <li class="card-text fs-6 p-2"> مجموع : {{number_format( $total)}} ﷼</li>
                            <li class="card-text fs-6 p-2"> انتخاب درگاه پرداخت :</li>
                            <div class="form-check col-6">
                                <label class="form-check-label" for="payment-z">
                                    در گاه پرداخت زرین پال
                                </label>
                                <input class="form-check-input" type="radio" name="payment-type" id="payment-z"
                                       value="zarinpal" checked>
                            </div>
                            <button class="btn btn-danger mt-2">پرداخت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

