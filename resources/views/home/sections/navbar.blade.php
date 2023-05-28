<nav class="navbar navbar-expand-md ">
    <div class="container m-0 border-info col-1">
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto fw-bold col-12 justify-content-center   border border-2 border-success ">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu  dropdown-menu-end  text-start "
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item mb-1 text-center text-success "
                               href="{{ route('profile.edit',['user'=>Auth::id()]) }}">
                                {{ __('user account') }}
                            </a>

                            @if( auth()->user()->role === \App\Http\constants\Constants::ADMIN)
                                <a class="dropdown-item mb-1 text-center text-success "
                                   href="{{ route('admin.feature.index') }}">
                                    {{ __('admin panel') }}
                                </a>
                            @endif
                            <a class="dropdown-item  text-center text-danger " href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            {{--            <ul class="navbar-nav col-2 fs-4 " >--}}
            {{--                <li><a href="{{route('booking.checkout')}}">  پرداخت  </a> </li>--}}

            {{--                <li><a href="{{route('booking.index')}}">   رزرو </a> </li>--}}
            {{--            </ul>--}}
        </div>
    </div>
</nav>
