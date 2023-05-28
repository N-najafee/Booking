@extends('home.layout.home')
@section("title")
    <p>blog</p>
@endsection

@section('content')
        <div class="container-fluid  bg-success  bg-opacity-50 p-3 align-items-center justify-content-center mb-5 ">

        <div class="container text-center">
            <h1 class="display-4">   {{$post->title}}</h1>
            <p class="lead">{{$post->short_description}}</p>
        </div>
    </div>


        <div class="feature-area" style="direction: rtl;" id="blog">
            <div class="container">
    <div class=" mb-3">
        <img src="{{url(env('IMAGE_POST_PATH').$post->photo)}}" class="card-img-top h-25" alt="...">
<div>
    <hr>
    <b class="m-3 text-muted"><i class="fa-regular fa-clock fa-2xl"></i> {{$post->updated_at}}  </b>


    <b class="m-3 text-muted"><i class="fa-regular fa-eye fa-2xl"></i> {{$post->total_view}}</b>
    <hr>
</div>


        <div class="card-body">
            <p class="card-text">{{$post->description}}</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>

            </div>
        </div>
    <div class="mt-5 col-12">
        <div class="row justify-content-center p-5">
        </div>
    </div>

@endsection
