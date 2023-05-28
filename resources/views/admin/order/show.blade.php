@extends('admin.layouts.admin')
@section("title")
    show - order details
@endsection
@section('content')

    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">نمایش لیست رزرو : </h5>
            </div>
            <hr>
            <div class="row ">
                <div class="form-group mt-4 col-3 ">
                    <label>نام مشتری </label>
                    <input class="form-control" type="text" value="{{$order->user->name}}" disabled>
                </div>
                <div class="form-group  mt-4  col-3 ">
                    <label>جمع کل </label>
                    <input class="form-control" type="text" value="{{number_format($order->paid_amount)}}" disabled>
                </div>
                <div class="form-group  mt-4  col-3 ">
                    <label>وضعیت پرداخت </label>
                    <input class="form-control" type="text"
                           class="{{$order->getraworiginal('status') === 1 ? "text-success" : "text-danger"}}"
                           value="{{$order->status}}" disabled>
                </div>
                <div class="form-group  mt-4  col-3">
                    <label>تاریخ پرداخت </label>
                    <input class="form-control" type="text" value="{{$order->booking_date}}" disabled>
                </div>
                <div class="form-group  mt-4  col-3">
                    <label>شماره تراکنش </label>
                    <input class="form-control" type="text" value="{{$order->transaction_no}}" disabled>
                </div>

                <div class="form-group  mt-4  col-3">
                    <label>تلفن </label>
                    <input class="form-control" type="text" value="{{$order->user->phone}}" disabled>
                </div>
                <div class="form-group  mt-4  col-3">
                    <label>ایمیل </label>
                    <input class="form-control" type="text" value="{{$order->user->email}}" disabled>
                </div>
            </div>
            <div class="form-group  mt-4  col-12">
                <label>آدرس </label>
                <textarea class="form-control" rows="3" cols="12" disabled>  {{$order->user->address}} </textarea>
            </div>
            <hr>
            <div class="m-4">
                <h5 class="font-weight-bold">جزییات لیست رزرو : </h5>
            </div>
            <div class="row">
                <table class="table table-bordered table-striped table-striped text-center">
                    <thead>
                    <tr>
                        <th>نام اتاق</th>
                        <th>تاریخ ورود</th>
                        <th>تاریخ خروج</th>
                        <th>بزرگسال</th>
                        <th>کودک</th>
                        <th>قیمت (هر شب)</th>
                        <th>جمع</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            <td>{{$detail->room->name}}</td>
                            <td>{{$detail->checkin_date}}</td>
                            <td>{{$detail->checkout_date}}</td>
                            <td>{{$detail->adult}}</td>
                            <td>{{$detail->children}}</td>
                            <td>{{number_format($detail->room->price)}}</td>
                            <td>{{number_format($detail->subtotal)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.order.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>

    </div>

@endsection

