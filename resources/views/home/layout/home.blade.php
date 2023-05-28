<!DOCTYPE html>
<html lang="fa" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{env('APP_NAME')}} - @yield('title')</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/home/home.css') }}" rel="stylesheet">
    <script src="{{asset('/fontasom/all.min.js')}}"></script>
    <style>

    </style>
</head>

<body>

<div class="wrapper" style="  display: flex;
    flex-direction: column;
    min-height: 100vh;">
    @include('home.sections.navbar')
    @include('home.sections.header')

    @yield('content')
</div>

@include('home.sections.footer')




<!-- JavaScript-->
<script src="{{ asset('/js/home/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('/js/home/plugins.js') }}"></script>
<script src="{{ asset('/js/home.js') }}"></script>
<script src="{{ asset('/js/rating.js') }}"></script>
<script>
    let message=$('#showMessage');
    let duration=9000;
    setTimeout(function() {
        if (message) {
            message.fadeOut('slow',function (){
                message.remove();
            });
        }
    }, duration);
</script>
@yield('script')
</body>

</html>
