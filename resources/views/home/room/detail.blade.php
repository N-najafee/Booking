@extends('home.layout.home')
@section("title")
    <p>room-detail</p>
@endsection

@section('content')
    <div class="container-fluid  bg-success  bg-opacity-50 p-3 align-items-center justify-content-center ">
        <div class="p-3 text-center">
            <h1 class="">{{$room->name}} </h1>
            <p class="lead">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                چاپگرها و متون بلکه روزنامه و مجله.</p>
        </div>
    </div>
    <div class="container-fluid p-5 ">
        <div class="row">
            <div class="col-8 p-3">
                <div class="card mb-4">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{url(env('ROOM_MAIN_PHOTO_PATH').$room->main_photo)}}"
                                     class="d-block w-100 imageCard " alt="...">
                            </div>
                            @foreach($room->roomPhotos as $photo)
                                <div class="carousel-item">
                                    <img src="{{url(env('ROOM_OTHER_PHOTO_PATH').$photo->photo)}}"
                                         class="d-block w-100 imageCard" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$room->description}}</p>
                </div>

                <div class="row mt-5">
                    <h3><b>امکانات</b></h3>
                    @foreach($room->amenities as $amenity)
                        <div class="col-6">
                            <div class="mb-4 me-2 p-4 bg-success bg-opacity-10  border border-2 border-success">
                                <p class="fs-5"><i class="fa fa-check-circle"></i> {{$amenity->name}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div>
                    <table class="table table-bordered p-5 fw-bold border border-2">
                        <tr>
                            <th>اندازه (مترمربع)</th>
                            <td>{{$room->size}}</td>
                        </tr>
                        <tr>
                            <th>تعداد اتاق</th>
                            <td>{{$room->total_rooms}}</td>
                        </tr>
                        <tr>
                            <th>تعداد تخت</th>
                            <td>{{$room->total_beds}}</td>
                        </tr>
                        <tr>
                            <th>تعداد سرویس</th>
                            <td>{{$room->total_bathroom}}</td>
                        </tr>
                        <tr>
                            <th>تعداد بالکن</th>
                            <td>{{$room->total_balconies}}</td>
                        </tr>
                        <tr>
                            <th>تعداد مهمان</th>
                            <td>{{$room->total_guests}}</td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <style>.h_iframe-aparat_embed_frame {
                            position: relative;
                        }

                        .h_iframe-aparat_embed_frame .ratio {
                            display: block;
                            width: 100%;
                            height: auto;
                        }

                        .h_iframe-aparat_embed_frame iframe {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }</style>
                    <div class="h_iframe-aparat_embed_frame">
                        <span style="display: block;padding-top: 57%"></span>
                        <iframe
                            src="https://www.aparat.com/video/video/embed/videohash/{{$room->video_code}}/vt/frame"
                            allowFullScreen="true" webkitallowfullscreen="true"
                            mozallowfullscreen="true"></iframe>

                    </div>

                </div>
                <div class="card mt-5">
                    <div class="card-header fs-5">
                        دیدگاه ها
                    </div>
                    <ul class="list-group list-group-flush p-3">
                        @forelse($room->comments as $comment)
                            <li class="list-group-item p-2">
                                <div class="row">
                                    <div class="d-flex card-title justify-content-between">
                                        <p>
                                          کاربر :    {{$comment->user->name}}
                                         </p>
                                        <p>
                                          تاریخ ایجاد :   {{$comment->created_at}}
                                        </p>

                                    </div>
                                    <div class="card-text">
                                        {{$comment->comment}}
                                    </div>
                                </div>

                            </li>
                        @empty

                        @endforelse
                    </ul>
                    @include('home.sections.message')
                    <form action="{{route('comment.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{$room->id}}">
                        <div class=" p-2">
                            <label for="comment" class="form-label fs-5"> متن دیدگاه :</label>
                            <textarea class="form-control @error('comment') {{'is-invalid'}} @enderror" rows="6"
                                      name="comment" id="comment"></textarea>
                            @error('comment') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <button class="btn btn-outline-primary m-3" type="submit">ارسال</button>
                    </form>
                </div>
            </div>


            <div class="col-4 ">
                <div class="position-fixed mb-5 p-5 ms-5" dir="ltr">
                    <div class="card text-dark bg-gray mb-4 " style="max-width: 30rem;">
                        <div class="card-header"><h5>قیمت هر شب اقامت</h5></div>
                        <div class="card-body">
                            <h5 class="card-title">{{number_format($room->price)}} ﷼ </h5>
                        </div>
                    </div>

                    <div class="card text-dark bg-gray mb-4 " style="max-width: 30rem;">
                        <form action="{{route('booking.store')}}" method="post" dir="rtl">
                            @csrf
                            <input type="hidden" name="room_id" value="{{$room->id}}">
                            <div class="card-header"><h5>تاریخ رزرو</h5></div>
                            <div class="card-body">
                                <label for="check_in">تاریخ ورود </label>
                                <input class="form-control @error('check_in') {{'is-invalid'}} @enderror" id="check_in"
                                       name="check_in" placeholder="تاریخ ورود" type="text" value="{{old('check_in')}}">
                                @error('check_in') <p class="invalid-feedback"> {{$message}}</p>@enderror
                            </div>
                            <div class="card-body">
                                <label for="check_out"> تاریخ خروج</label>
                                <input class="form-control @error('check_out') {{'is-invalid'}} @enderror"
                                       id="check_out" name="check_out" placeholder="تاریخ خروج" type="text"
                                       value="{{old('check_out')}}">
                                @error('check_out') <p class="invalid-feedback"> {{$message}}</p>@enderror
                            </div>
                            <div class="row p-2 ">
                                <div class="card-body col-6">
                                    <label for="adult">بزرگسال</label>
                                    <input class="form-control @error('adult') {{'is-invalid'}} @enderror" id="adult"
                                           name="adult" min="1" type="number" value="{{old('adult')}}">
                                    @error('adult') <p class="invalid-feedback"> {{$message}}</p>@enderror
                                </div>
                                <div class="card-body col-6">
                                    <label for="children">کودک</label>
                                    <input class="form-control @error('children') {{'is-invalid'}} @enderror"
                                           id="children" name="children" min="0" type="number"
                                           value="{{old('children')}}">
                                    @error('children') <p class="invalid-feedback"> {{$message}}</p>@enderror
                                </div>
                            </div>
                            <div class=" border-info p-2">
                                <button class="btn btn-outline-danger">افزودن به رزرو</button>
                            </div>


                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection

