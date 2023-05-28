<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{env('APP_NAME')}} - @yield('title')</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet">
    <script src="{{asset('/fontasom/all.min.js')}}"></script>
<style>

</style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">


    <!-- Sidebar -->
      @include('admin.sections.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        @include('admin.sections.topbar')
      <!-- Main Content -->
      <div id="content">
          <div class="col-3">
@include('admin.sections.message')
          </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
   @include('admin.sections.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
 @include('admin.sections.scrolltop')

  <!-- Logout Modal-->

  <!-- JavaScript-->
<script src="{{ asset('/js/admin.js') }}"></script>
  <script>
      let message=$('#showMessage');
      let duration=2000;
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
