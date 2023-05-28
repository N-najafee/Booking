<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>order details</title>
    <link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="p-2">
    <h3> با سلام </h3>
    <h4>{{$user->name}} عزیز </h4>
    <h6>جزییات رزرو شما به شرح زیر می باشد :</h6>
    <p> شماره تراکنش  : {{$authority}}</p>
</div>
    <div class="row justify-content-start p-1 mt-3">
        <div class="col-12">
            <table class="table table-bordered  text-center">
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
                @foreach($booking as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{number_format($item['price'])}}</td>
                        <td>{{$item['check_in']}}</td>
                        <td>{{$item['check_out']}}</td>
                        <td>{{$item['adult']}}</td>
                        <td>{{$item['children']}}</td>
                        <td>{{number_format($item['subtotal'])}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table table-bordered ">
                <tr>
                    <td colspan="6" class="text-start"> جمع کل :</td>
                    <td>
                        {{(number_format( $totalAmount))}}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="p-2 ">
<h4>با تشکر </h4>
<h2>{{env('APP_NAME')}} </h2>
</div>
</body>
</html>


