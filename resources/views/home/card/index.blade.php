@extends('home.layout.home')
@section("title")
    reserve-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="container-fluid  bg-success  bg-opacity-50 p-3 align-items-center justify-content-center ">
        <div class="p-3 text-center">
            <h1 class=""> رزرو </h1>
        </div>
    </div>

    <div class="row align-items-center justify-content-center p-5">
        <div class="col-11 ">
            <div class="fs-6 text-center text-primary w-25 ">
                @include('home.sections.message')
            </div>
            <table class="table table-bordered  border-dark  text-center  ">
                <thead class="bg-success bg-opacity-25">
                <tr>
                    <th>#</th>
                    <th>سریال</th>
                    <th>عکس</th>
                    <th>نام اتاق</th>
                    <th>قیمت</th>
                    <th>تاریخ ورود</th>
                    <th>تاریخ خروج</th>
                    <th> مهمان</th>
                    <th>جمع</th>
                </tr>
                </thead>
                @if(session()->has('booking_'.auth()->id()))
                    <tbody>
                    @php       $total=0 @endphp
                    @foreach($reserves as $key=>$reserve)
                        @php       $total+=$reserve['subtotal'] @endphp

                        <tr>
                            <td class="text-center text-danger">

                                <!-- Button trigger modal -->
                                <p type="button" class="text-danger" data-bs-toggle="modal"
                                   data-bs-target="#staticBackdrop-{{$key}}">
                                    <i class="fa-solid fa-xmark fa-2xl"></i>
                                </p>
                                <!-- Modal -->
                                <div class="modal " id="staticBackdrop-{{$key}}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content w-50">
                                            <div class="modal-body text-dark fs-5">
                                                ایا از حذف این آیتم مطمئن هستید؟
                                            </div>

                                            <div class="modal-footer justify-content-start">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    بستن
                                                </button>
                                                <form action="{{route('booking.destroy',['booking'=>$key])}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" value="حذف">حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td class="text-center">  {{$key+1}} </td>
                            <td class="text-center">
                                <a href="{{url((env('ROOM_MAIN_PHOTO_PATH').$reserve['main_photo']))}}" alt="image"
                                   target="_blank">
                                    <img src="{{url(env('ROOM_MAIN_PHOTO_PATH').$reserve['main_photo'])}}" alt="image"
                                         class="card-img image15 smimg" style="width: 10rem ; height: 10rem">
                                </a>
                            </td>
                            <td class="text-center wrapper">  {{$reserve['name']}}  </td>
                            <td class="text-center wrapper">  {{number_format($reserve['price'])}} ﷼</td>

                            <td class="text-center wrapper">  {{$reserve['check_in']}}  </td>
                            <td class="text-center wrapper">  {{$reserve['check_out']}}  </td>
                            <td class="text-center wrapper">
                                <ul>
                                    <li class="list-group-item"> بزرگسال : {{ $reserve['adult']}}</li>
                                    <li class="list-group-item"> کودک : {{ $reserve['children']}}</li>
                                </ul>

                            </td>
                            <td class="text-center">

                                {{number_format($reserve['subtotal']) }}
                            </td>
                        </tr>

                    @endforeach
                    </tbody>

                    <tfoot class="table table-bordered border border-dark ">
                    <tr>
                        <td colspan="8" class="text-start"> جمع کل :</td>
                        <td>
                            {{(number_format( $total))}}
                        </td>
                    </tr>
                    </tfoot>
                @endif
            </table>
            <a href="{{route('booking.checkout')}}" class="btn btn-outline-success">رزرو نهایی</a>
        </div>
    </div>

@endsection

