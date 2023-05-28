@extends('admin.layouts.admin')
@section("title")
    amenity-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست امکانات رفاهی </h5>
                <a href="{{route('admin.amenity.create')}}" class="btn btn-outline-primary">
                    ایجاد امکانات رفاهی
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($amenities as $key=>$amenity)
                <tr>
                    <td>  {{$amenities->firstitem() + $key}} </td>
                    <td>  {{$amenity->name}} </td>
                    <td >
                        <div class="row justify-content-center">
                            <div class="d-flex align-items-center justify-content-center ">
                                <a class="btn btn-outline-info" href="{{route('admin.amenity.edit',['amenity'=>$amenity->id])}}">ویرایش</a>
                                <form action="{{route('admin.amenity.destroy',['amenity'=>$amenity->id])}}" method="post">
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
                    {{$amenities->render()}}
            </div>
            </div>
        </div>
@endsection
