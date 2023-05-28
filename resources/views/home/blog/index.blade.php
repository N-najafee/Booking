@extends('home.layout.home')
@section("title")
    <p>blog</p>
@endsection

@section('content')
    <div class="container-fluid mb-5 bg-success  bg-opacity-50 p-3 align-items-center justify-content-center ">

        <div class="container text-center">
            <h1 class="display-4">پست ها </h1>
            <p class="lead">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                چاپگرها و متون بلکه روزنامه و مجله.</p>
        </div>
    </div>
    <div class="feature-area " style="direction: rtl;" id="blog">
        <div class="container-fluid text-center p-3 ">
            <div class="row row-cols-1 row-cols-md-3 ">
                @foreach($posts as $post)
                    <div class="card-group  col-3 mt-3">
                        <div class="card p-3 mb-4">
                            <img src="{{url(env('IMAGE_POST_PATH').$post->photo)}}" alt="image" class=" image15">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}} </h5>
                                <p class="card-text">{{$post->short_description}}</p>
                            </div>
                            <p class="card-text"><a href="{{route('blog.show',['post'=>$post->id])}}"
                                                    class="btn btn-outline-success text-dark bg-success bg-opacity-10 col-12">ادامه
                                    مطلب</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-5 col-12">
        <div class="row justify-content-center p-5">
            <div class="col-2">
                {{$posts->render()}}
            </div>
        </div>
    </div>

@endsection
