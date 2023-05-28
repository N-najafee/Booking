@extends('home.layout.home')
@section("title")
    index
@endsection
@section('content')
    <div class="col-12">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{url(env('IMAGE_HOME_PATH')."slide1.jpg")}}" class="d-block w-100" height="600rem" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{url(env('IMAGE_HOME_PATH')."slide2.jpg")}}" class="d-block w-100" height="600rem" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{url(env('IMAGE_HOME_PATH')."slide3.jpg")}}" class="d-block w-100" height="600rem" alt="...">
                </div>
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
    <div class="container">
        <div class="feature-area text-center bg-aliceblue border border-2  m-3" style="direction: rtl;">
            <div class="card text-center p-5">
                <form action="{{route('booking.store')}}" method="post" id="reserved">
                    @csrf
                    <div class="row">
                        @include('admin.sections.message')
                        <div class="form-group col-3 mt-4">
                            <select
                                class="form-select form-select-lg mb-3 text-muted @error('room_id') {{'is-invalid'}} @enderror"
                                name="room_id" aria-label=".form-select-lg example">
                                <option selected>لیست اتاق ها</option>
                                @foreach($allRoom as $room)
                                    <option value="{{$room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                            @error('room_id') <p class="{{'invalid-feedback'}}"> {{$message}}</p>@enderror
                        </div>

                        <div class="form-group col-md-2 mt-4">
                            <input class="form-control @error('check_in') {{'is-invalid'}} @enderror" id="check_in"
                                   name="check_in" type="text" placeholder="تاریخ ورود " value="{{old('check_in')}}">
                            @error('check_in') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-2 mt-4">
                            <input class="form-control @error('check_out') {{'is-invalid'}} @enderror" id="check_out"
                                   name="check_out" type="text" placeholder=" تاریخ خروج" value="{{old('check_out')}}">
                            @error('check_out') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-2 mt-4">
                            <input class="form-control @error('children') {{'is-invalid'}} @enderror" id="children"
                                   name="children" placeholder="کودک" type="number" min="0" value="{{old('children')}}">
                            @error('children') <p class="invalid-feedback"> {{$message}}</p>@enderror
                        </div>
                        <div class="form-group col-2 mt-4">
                            <input class="form-control @error('adult') {{'is-invalid'}} @enderror" id="adult"
                                   name="adult" placeholder="بزرگسال" type="number" min="1" value="{{old('adult')}}">
                            {{--                @error('adult')  <p class="invalid-feedback"> {{$message}}</p>@enderror--}}
                        </div>
                        <div class="form-group col-1 mt-4 ">

                            <input class="btn btn-outline-success border border-2 border-success  text-center "
                                   type="submit" value="رزرو">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="feature-area text-center" style="direction: rtl;" id="blog">
            <div class="container text-center">
                <h1>اتاق ها و سوییت </h1>
            </div>
            <div class="row  row-cols-md-3 m-4">
                @foreach($rooms as $room)
                    <div class="card-group  col-3 mt-3">
                        <div class="card p-3 mb-4">
                            <img src="{{url(env('ROOM_MAIN_PHOTO_PATH').$room->main_photo)}}" alt="image"
                                 class=" image15">
                            <div class="card-body">
                                <h5 class="card-title ">{{$room->name}} </h5>
                                <p class="card-text">{{number_format($room->price)}} ﷼</p>
                            </div>
                            <p class="card-text "><a href="{{route('room.detail',['id'=>$room->id])}}"
                                                     class="btn btn-outline-success text-dark bg-success bg-opacity-10 col-12">نمایش
                                    جزییات</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{route('room.list')}}" class="btn btn-outline-success btn-lg text-dark " tabindex="-1"
               role="button" aria-disabled="true">مشاهده لیست اتاق ها</a>

        </div>
    </div>

    <div class="product-area ptb-60">
        <div class="container-fluid ">
            <div class="section-title text-center  pb-60">
                <div class="card "></div>
                <h2 class="mt-4">ویژگی ها</h2>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها
                    و متون
                    بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
                </p>
            </div>
            <div class="row align-content-center p-2 bg-success bg-opacity-10">
                @foreach($features as $feature)
                    <div class="card p-2 text-center rounded rounded-pill m-4 " style="width: 15rem;">
                        <div  class="card-body">
                            <div class="fa-4x text-center">
                                <i class="{{$feature->icon}} "></i>
                        </div>
                            <p>{{$feature->title}}</p>
                            <p>{{$feature->description}}</p>
                    </div>
                    </div>
                @endforeach
        </div>
    </div>


    <div class="feature-area " style="direction: rtl;" id="blog">
        <div class="container-fluid text-center p-3 mt-4">
            <h1>آخرین پست ها </h1>
            <div class="row row-cols-1 row-cols-md-3 m-4" id="postsList" >
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
            <button class="btn btn-outline-success btn-lg text-dark mb-3"
                    id="loadMore" data-page="{{ $posts->currentPage() }}">مشاهده بیشتر
            </button>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $('#loadMore').click(function () {
            let nextPage = $(this).data('page') + 1;
            $.get(`{{ url('/hotel/load-more') }}?page=${nextPage}`, function (response, status) {
                if (status === 'success') {
                    if (response.length > 0) {
                        response.forEach(function (post) {
                            let postItem = `
                            <div class="card-group col-3 mt-3">
                                <div class="card p-3 mb-4">
                                    <img src="{{ url(env('IMAGE_POST_PATH')) }}/${post.photo}" alt="image" class="image15">
                                    <div class="card-body">
                                        <h5 class="card-title">${post.title}</h5>
                                        <p class="card-text">${post.short_description}</p>
                                    </div>
                                    <p class="card-text">
                                        <a href="{{url('blog/${post.id}')}}" class="btn btn-outline-success text-dark bg-success bg-opacity-10 col-12">
                            ادامه مطلب

                                        </a>
                                    </p>
                                </div>
                            </div>
                        `;
                            $('#postsList').append(postItem);

                        });
                        $('#loadMore').data('page', nextPage);
                    }
                } else {
                    alert("پستی جهت مشاهده بیشتر وجود ندارد");
                    $('#loadMore').addClass('d-none');
                }
            }).fail(function () {
                alert("مشکل در دریافت اطلاعات")
            });
        });
    </script>
@endsection
