@extends('home.layout.home')

@section('title')
    edit  user profile
@endsection

@section('content')
    <div class="container-fluid  bg-success  bg-opacity-50 p-3  justify-content-center ">
        <div class="p-3 text-center">
            <h1 class=""> </h1>
            <p class="lead">حساب کاربری</p>
        </div>
    </div>

    <div class="container-fluid p-5 " >
        <div class="row">

            <div class="col-4 p-2">
                <div class="card p-3 " style="width: 25rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item btn btn-outline-success "> <a  href="{{route('profile.edit',['user'=>auth()->id()])}}">پروفایل</a></li>
                        <li class="list-group-item btn btn-outline-success ">  <a  href="{{route('profile.index')}}"> لیست رزرو </a></li>
                        <li class="list-group-item btn btn-outline-success ">نظرات</li>
                        <li class="list-group-item btn btn-outline-danger ">خروج</li>
                    </ul>

                </div>
            </div>
            <div class="col-8  border  p-5">
                <div class="mb-4">
                    <h5 class="font-weight-bold">لیست رزرو  </h5>
                </div>
                <hr>
@if($orders)
                    <div class="row">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>تاریخ</th>
                                <th>وضعیت پرداخت</th>
                                <th>جمع کل</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{$order->booking_date}}</td>

                                    <td class="text-center {{$order->getraworiginal('status') === 1 ? "text-success" : "text-danger"}}" >{{$order->status}}</td>
                                    <td class="text-center">{{number_format($order->paid_amount)}}</td>
                                    <td class="text-center">
                                        <div class="row justify-content-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <!-- Scrollable modal -->
                                                <button type="button" class="btn btn-outline-primary m-2" {{$order->getraworiginal('status') !== 1 ? "disabled" : ""}} data-bs-toggle="modal" data-bs-target="#Modal_{{$key}}">
                                                    مشاهده جزییات
                                                </button>
                                                <div class="modal modal-dialog-scrollable" id="Modal_{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content text-end">
                                                            <div class="modal-header d-flex">
                                                                <h3 class="p-2">جزییات لیست رزرو</h3>
                                                                <h5 type="button" data-bs-dismiss="modal"><i class="fa-solid fa-xmark fa-xl"></i></h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped table-striped text-center">
                                                                <thead>
                                                                <tr>
                                                                    <th>نام اتاق</th>
                                                                    <th>قیمت (هر شب)</th>
                                                                    <th>تاریخ ورود</th>
                                                                    <th>تاریخ خروج</th>
                                                                    <th>بزرگسال</th>
                                                                    <th>کودک</th>
                                                                    <th>جمع</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($order->orderDetails as $detail)
                                                                    <tr>
                                                                        <td>{{$detail->room->name}}</td>
                                                                        <td>{{number_format($detail->room->price)}}</td>
                                                                        <td>{{$detail->checkin_date}}</td>
                                                                        <td>{{$detail->checkout_date}}</td>
                                                                        <td>{{$detail->adult}}</td>
                                                                        <td>{{$detail->children}}</td>
                                                                        <td>{{number_format($detail->subtotal)}}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Scrollable modal -->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="alert alert-info text-center fs-6 ">
                      لیست رزرو خالی می باشد
                    </div>
                @endif
        </div>
    </div>
    </div>
@endsection
