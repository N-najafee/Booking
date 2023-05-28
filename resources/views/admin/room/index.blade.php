@extends('admin.layouts.admin')
@section("title")
    room-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست اتاق ها </h5>
                <a href="{{route('admin.room.create')}}" class="btn btn-outline-primary">
                    ایجاد اتاق
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>قیمت</th>
                    <th>لینک عکس</th>
                    <th>لینک ویدیو</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $key=>$room)
                    <tr>
                        <td class="text-center">  {{$rooms->firstitem() + $key}} </td>
                        <td class="text-center">  {{$room->name}} </td>
                        <td class="text-center ">  {{number_format( $room->price)}} </td>
                        <td class="text-center">
                            <a href="{{url((env('ROOM_MAIN_PHOTO_PATH').$room->main_photo))}}" alt="image"
                               target="_blank">
                                <img src="{{url(env('ROOM_MAIN_PHOTO_PATH').$room->main_photo)}}" alt="image"
                                     class="card-img " style="width:100%; height: 100px">
                            </a>
                        </td>
                        <td >
                            <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style>
                            <div class="h_iframe-aparat_embed_frame" style="width:200%; height: 100px">
                                <span style="display: block;padding-top: 57%"></span>
                                <iframe src="https://www.aparat.com/video/video/embed/videohash/{{$room->video_code}}/vt/frame"  allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="row justify-content-center">
                                <div class="d-flex align-items-center justify-content-center ">
                                    <!-- Scrollable modal -->
                                    <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal"
                                            data-bs-target="#Modal_{{$key}}">
                                        مشاهده جزییات
                                    </button>
                                    <div class="modal modal-dialog-scrollable" id="Modal_{{$key}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content text-end ">
                                                <div class="modal-header d-flex ">
                                                    <h3 class="p-2">جزییات اتاق</h3>
                                                    <h5 type="button" data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-xmark fa-xl"></i></h5>
                                                </div>
                                                <h5 class="modal-title p-2"
                                                    id="exampleModalLabel"><b>نام اتاق :</b> {{$room->name}}</h5>
                                                <div class="modal-body">
                                                    <div class="card-img">
                                                        <div class="card-img-top">
                                                            <img style="width: 450px; height:250px" alt="attach"
                                                                 src=" {{url(env('ROOM_MAIN_PHOTO_PATH').$room->main_photo)}}">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h4>توضیحات:</h4>
                                                    <p>{{$room->description}}</p>
                                                    <div class="row">
                                                        <table class=" table border border-top str bounce">
                                                            <tr>
                                                                <td>
                                                                    تعداد اتاق
                                                                </td>
                                                                <td>
                                                                    {{$room->total_rooms}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    تعداد مهمان
                                                                </td>
                                                                <td>
                                                                    {{$room->total_guests}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    امکانات
                                                                </td>
                                                                <td>
                                                                    @foreach($room->amenities as $amenity)
                                                                        <p>{{$amenity->name}}</p>
                                                                    @endforeach

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    تعداد تخت
                                                                </td>
                                                                <td>
                                                                    {{$room->total_beds}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    تعداد سرویس
                                                                </td>
                                                                <td>
                                                                    {{$room->total_bathroom}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    تعداد بالکن
                                                                </td>
                                                                <td>
                                                                    {{$room->total_balconies}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    اندازه اتاق
                                                                </td>
                                                                <td>
                                                                    {{$room->size}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    قیمت (هر شب)
                                                                </td>
                                                                <td>
                                                                    {{number_format( $room->price)}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                @if($room->video_code)
                                                    <div class="text-center wrapper">
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
                                                @endif
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                        بستن
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Scrollable modal -->
                                    <div class="dropdown d-flex">
                                        <p class="btn dropdown-toggle btn btn-outline-info mx-3 mt-3" dir="rtl"
                                           id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            ویرایش
                                        </p>
                                        <ul class="dropdown-menu text-end" dir="rtl"
                                            aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item"
                                                   href="{{route('admin.room.edit',['room'=>$room->id])}}"> اتاق </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('admin.room-photo.edit',['room'=>$room->id])}}">گالری
                                                    تصاویر</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown d-flex">
                                        <p class="btn dropdown-toggle btn btn-outline-primary mx-3 mt-3" dir="rtl"
                                           id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            نمایش
                                        </p>
                                        <ul class="dropdown-menu text-end" dir="rtl"
                                            aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item"
                                                   href="{{route('admin.room.show',['room'=>$room->id])}}"> اتاق </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('admin.room-photo.show',['room'=>$room->id])}}">گالری
                                                    تصاویر</a></li>
                                        </ul>
                                    </div>
                                    <form action="{{route('admin.room.destroy',['room'=>$room->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger me-2">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="mt-5 col-12">
            <div class="row justify-content-center p-5">
                <div class="col-4">
                    {{$rooms->render()}}
                </div>
            </div>
        </div>
@endsection
