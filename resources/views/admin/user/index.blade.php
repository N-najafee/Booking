@extends('admin.layouts.admin')
@section("title")
    user-index
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست کاربران </h5>
                <a href="{{route('admin.user.create')}}" class="btn btn-outline-primary">
                    ایجاد کاربر
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered  table-striped table-striped text-center ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام کاربر</th>
                    <th>نقش</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                    <tr>
                        <td>  {{$users->firstitem() + $key}} </td>
                        <td>  {{$user->name}} </td>
                        <td>  {{ \App\Http\constants\Constants::ROLE_USER[$user->role ]}} </td>

                        <td class="{{$user->getraworiginal('status')===1 ? "text-success" : "text-danger"}}">  {{$user->status}} </td>
                        <td>
                            <div class="row justify-content-center">
                                <div class="d-flex align-items-center justify-content-center ">
                                    <a class="btn btn-outline-success"
                                       href="{{route('admin.user.edit',['user'=>$user->id])}}">ویرایش</a>
                                    <a class="btn btn-outline-primary me-2"
                                       href="{{route('admin.user.show',['user'=>$user->id])}}"> نمایش</a>
                                    <form action="{{route('admin.user.destroy',['user'=>$user->id])}}" method="post">
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
                    {{$users->render()}}
                </div>
            </div>
        </div>
@endsection
