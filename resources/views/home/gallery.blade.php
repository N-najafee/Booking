@extends('home.layout.home')
@section("title")
    <p>gallery</p>
@endsection

@section('content')
    <div class="container-fluid mb-5 bg-success  bg-opacity-50 p-3 align-items-center justify-content-center ">

        <div class="container text-center">
            <h1 class="display-4">ویدیو ها </h1>
            <p class="lead">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                چاپگرها و متون بلکه روزنامه و مجله.</p>
        </div>
    </div>

    <div class="feature-area" style="direction: rtl;" id="blog">
        <div class="container-fluid text-center p-3">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach($videos as $video)
                    <div class="card-group  col-3 mt-3">
                    <div class="card p-3 mb-4">
                        <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style>
                        <div class="h_iframe-aparat_embed_frame">
                            <span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/{{$video->video_code}}/vt/frame"  allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$video->description}}</p>
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-5 col-12">
        <div class="row justify-content-center p-5">
            <div class="col-2">
            {{$videos->render()}}
            </div>
        </div>
    </div>

@endsection
