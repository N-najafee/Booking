@extends('admin.layouts.admin')
@section("title")
    order-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست رزروها </h5>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام مشتری</th>
                    <th> تاریخ پرداخت</th>
                    <th>وضعیت پرداخت</th>
                    <th>جمع کل</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key=>$order)
                    <tr>
                        <td class="text-center">  {{$orders->firstitem() + $key}} </td>
                        <td class="text-center">  {{$order->user->name}} </td>
                        <td class="text-center">     {{$order->booking_date}} </td>
                        <td class="text-center {{$order->getraworiginal('status') === 1 ? "text-success" : "text-danger"}}">{{$order->status}}</td>
                        <td class="text-center">{{number_format($order->paid_amount)}}</td>

                        <td class="text-center">
                            <a href="{{route('admin.order.show',['order'=>$order->id])}}">
                                <button
                                    class="btn btn-outline-info" {{$order->getraworiginal('status') !== 1 ? "disabled" : ""}} >
                                    مشاهده جزییات
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="mt-5 col-12">
            <div class="row justify-content-center p-5">
                <div class="col-4">
                    {{$orders->render()}}
                </div>
            </div>
        </div>
@endsection

