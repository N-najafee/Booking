<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0 " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">پنل ادمین</div>

    </div>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('hotel')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item  -->
    <li class="nav-item {{\Illuminate\Support\Facades\Request::is('admin/comment')?'active':''}}">
        <a class="nav-link" href="{{route('admin.comment.index')}}">
            <i class="fas fa-store"></i>
            <span>  لیست نظرات </span>
        </a>
    </li>
    <li class="nav-item {{\Illuminate\Support\Facades\Request::is('admin/post')?'active':''}}">
        <a class="nav-link" href="{{route('admin.post.index')}}">
            <i class="fas fa-store"></i>
            <span>  بلاگ </span>
        </a>
    </li>
    <li class="nav-item  {{\Illuminate\Support\Facades\Request::is('admin/video') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.video.index')}}">
            <i class="fas fa-store"></i>
            <span>  گالری </span>
        </a>
    </li>
    <li class="nav-item {{\Illuminate\Support\Facades\Request::is('admin/feature')?'active':''}}">
        <a class="nav-link" href="{{route('admin.feature.index')}}">
            <i class="fas fa-store"></i>
            <span>  ویژگی ها </span>
        </a>
    </li>

    <li class="nav-item  {{\Illuminate\Support\Facades\Request::is('admin/user') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.user.index')}}">
            <i class="fas fa-store"></i>
            <span> کاربران </span>
        </a>
    </li>
    <li>
    </li>
    <li class="nav-item {{\Illuminate\Support\Facades\Request::is('admin/amenity') ? "active" : ""}}">
        <p class="nav-link collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#collapseHotel"
           aria-expanded="false" aria-controls="collapseHotel">
            <i class="fas fa-fw fa-cart-plus"></i>
            بخش اتاق ها
        </p>
        <div class="collapse   rounded " id="collapseHotel">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{\Illuminate\Support\Facades\Request::is('admin/order') ? "active" : ""}}"
                   href="{{route('admin.order.index')}}"> لیست رزرو ها</a>
                <a class="collapse-item {{\Illuminate\Support\Facades\Request::is('admin/amenity') ? "active" : ""}}"
                   href="{{route('admin.amenity.index')}}"> امکانات</a>
                <a class="collapse-item {{\Illuminate\Support\Facades\Request::is('admin/room') ? "active" : ""}}"
                   href="{{route('admin.room.index')}}">اتاق ها</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="text-center  p-2">
            <button class="rounded rounded-circle p-3">خروج</button>
        </div>
    </form>

</ul>




