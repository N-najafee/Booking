@extends('admin.layouts.admin')
@section("title")
    feature-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست ویژگی ها </h5>
                <a href="{{route('admin.feature.create')}}" class="btn btn-outline-primary">
                    ایجاد ویژگی
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>آیکون</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($features as $key=>$feature)
                <tr>
                    <td>  {{$features->firstitem() + $key}} </td>
                    <td>  {{$feature->title}} </td>
                    <td > <i class="{{$feature->icon}} fa-2xl"></i></td>
                    <td >
                        <div class="row justify-content-center">
                            <div class="d-flex align-items-center justify-content-center ">
                        <a class="btn btn-outline-info mr-3 " href="{{route('admin.feature.edit',['feature'=>$feature->id])}}" >ویرایش</a>
                        <form action="{{route('admin.feature.destroy',['feature'=>$feature->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger me-2 ">حذف</button>

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
                    {{$features->render()}}
            </div>
            </div>
        </div>
@endsection
