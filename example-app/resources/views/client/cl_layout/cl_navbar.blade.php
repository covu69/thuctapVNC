<!-- Navbar Start -->
<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
            <a href="index.html" class="navbar-brand">
                <img style="max-width:100%;height:auto" src="{{asset('cl/img/logo.png')}}" alt="Logo">
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="{{route('home')}}" class="nav-item nav-link {{ (Route::currentRouteName() == 'home') ? 'active' : '' }}">{{ trans('messages.trangchu') }}</a>
                    <a href="{{route('all_post')}}" class="nav-item nav-link {{ (request()->is('user/all_post*')) ?  'active' : ''}}">{{ trans('messages.tintuc') }}</a>
                    <a href="{{route('calendar')}}" class="nav-item nav-link {{ (request()->is('calendar*')) ?  'active' : ''}}">{{ trans('messages.lich') }}</a>
                    @foreach($pages as $page)
                    <a class="nav-item nav-link {{ (request()->is('user/pages/' . $page->id . '*')) ? 'active' : '' }}" href="{{ route('pages', $page->id) }}">{{ $page->title }}</a>
                    @endforeach
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ trans('messages.taikhoan') }}</a>
                        <div class="dropdown-menu bg-light rounded-0 m-0">
                            @if(Auth::Check())
                            <a href="{{route('dashboard')}}" class="dropdown-item">{{ trans('messages.admin') }}</a>
                            <a href="{{route('logout')}}" class="dropdown-item"><i class="pe-7s-lock"></i>{{ trans('messages.dangxuat') }}</a>
                            @else
                            <a href="{{route('login')}}" class="dropdown-item"><i class="pe-7s-lock"></i>{{ trans('messages.dangnhap') }}</a>
                            @endif
                        </div>
                    </div>
                    <a href="{{route('lienhe')}} " class="nav-item nav-link {{ (request()->is('user/lienhe*')) ?  'active' : ''}}">{{ trans('messages.lienhe') }}</a>
                    <a class="nav-item nav-link" href="{{ route('changeLanguage', ['locale' => 'vi']) }}">Vi</a>
                    <a class="nav-item nav-link" href="{{ route('changeLanguage', ['locale' => 'en']) }}">En</a>
                </div>
                <div class="border-start ps-4 d-none d-lg-block">
                    <button type="button" class="btn btn-sm p-0"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->