<header class="header-area sticky-bar">
    <div class="main-header-wrap">
        <div class="container">
            <div class="row border-dark">
                <div class="col-xl-7 col-lg-7">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li class="angle-shape" ><a href="{{route('booking.checkout')}}">  پرداخت  </a> </li>

                                <li class="angle-shape"> <a href="{{route('booking.index')}}">   رزرو </a> </li>

                                <li>
                                    <div class="dropdown d-flex">
                                        <p class=" dropdown-toggle" dir="rtl" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            سوییت و اتاق ها
                                        </p>
                                        <ul class="dropdown-menu  text-end" dir="rtl" aria-labelledby="dropdownMenuButton">
                                            @foreach(\App\Models\Room::all() as $room)
                                            <li><a class="dropdown-item" href="{{route('room.detail',['id'=>$room->id])}}">{{$room->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                <li><a href="{{route('blog.list')}}"> وبلاگ </a></li>
                                <li><a href="{{route('gallery')}}"> گالری </a></li>

                                <li class="angle-shape">
                                    <a href="{{route('hotel')}}"> صفحه اصلی </a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
