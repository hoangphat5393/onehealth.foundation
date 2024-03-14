@php
    // if (Auth::check()) {
    //     $user = Auth::user();
    //     $avatar = public_path('img/users/avatar/') . $user->avatar;
    // }
@endphp

<header id="header" class="header">
    <div class="container">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ Route::localizedUrl('vi') }}">@lang('Viet Nam')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ Route::localizedUrl('en') }}">@lang('English')</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">@lang('Login')</a>
            </li> --}}
        </ul>
    </div>

    @php
        $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
    @endphp

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ get_image(setting_option('logo')) }}" class="logo" alt="{{ setting_option('webtitle') }}" style="height:80px">
            </a>
            <div class="d-none d-lg-block">
                <div class="d-flex camp-group-block">
                    <div class="left-block fw-semibold">
                        @lang('Create your campaign')
                    </div>
                    <a href="{{ route('page', 'donate') }}" class="d-block right-block fw-bold">
                        @lang('Donate now')
                    </a>
                </div>
            </div>
            <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    {{-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        @foreach ($headerMenu->items as $item)
                            @php $hasChild = $item->child()->exists(); @endphp
                            @if ($hasChild != 1)
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{ $item->link }}">{{ $item->label }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $item->label }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($item->child as $item2)
                                            <li><a class="dropdown-item" href="{{ $item->link }}">{{ $item2->label }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <form class="d-flex" role="search" method="get" action="{{ route('search') }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control input-search" placeholder="@lang('Search')" aria-label="@lang('Search')" aria-describedby="basic-addon2">
                            <button type="submit" class="input-group-text btn-search" id="search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
