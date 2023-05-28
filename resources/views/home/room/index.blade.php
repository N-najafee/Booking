@extends('home.layout.home')
@section("title")
    <p>rooms</p>
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid bg-aliceblue mb-5">
        <div class="container text-center">
            <h1 class="display-4">اتاق ها </h1>
            <p class="lead">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                چاپگرها و متون بلکه روزنامه و مجله.</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="feature-area" style="direction: rtl;" id="blog">
            <div class="container text-center">
                <h1>اتاق ها و سوییت </h1>
            </div>
            <div class="row  row-cols-md-3 m-4">
                @foreach($rooms as $room)
                    <div class="card-group  col-3 mt-3">
                        <div class="card p-3 mb-4">
                            <img src="{{url(env('ROOM_MAIN_PHOTO_PATH').$room->main_photo)}}" alt="image" class=" image15">
                            <div class="card-body">
                                <h5 class="card-title ">{{$room->name}} </h5>
                                <p class="card-text">{{number_format($room->price)}} ﷼</p>
                            </div>
                            <p class="card-text"><a href="{{route('room.detail',['id'=>$room->id])}}" class="btn text-dark bg-info col-12">نمایش جزییات</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>



    <div class="mt-5 col-12">
        <div class="row justify-content-center p-5">
            <div class="col-2">
            {{$rooms->render()}}
            </div>
        </div>
    </div>

@endsection
