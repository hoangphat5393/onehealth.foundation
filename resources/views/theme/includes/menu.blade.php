@php
    $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
@endphp

<nav class="navbar navbar-expand-lg menu-wrap">
    <div class="container">
        {{-- <a class="navbar-brand" href="#">Navbar scroll</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            {{-- <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-column" style="--bs-scroll-height: 100px;"> --}}
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Chúng tôi là ai?
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Ban giám đốc</a></li>
                        <li><a class="dropdown-item" href="#">Tầm nhìn</a></li>
                        <li><a class="dropdown-item" href="#">Sứ mệnh</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    {{-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hoạt động
                    </a> --}}
                    <a class="nav-link" href="{{ route('news.category', 'hoat-dong') }}"> Hoạt động</a>
                    {{-- <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul> --}}
                </li>
                <li class="nav-item dropdown position-static">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dự án
                    </a>
                    <div class="dropdown-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/m2030-2/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/257657916.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/trung-tam-thu-gom-rac-thai/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/plastic_bank-1.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <a href="{{ route('index') }}" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/10/key-project-4.jpg" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <ul class="dropdown-menu list-inline">
                        <li class="list-inline-item">
                            <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                <img src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="img-fluid" alt="" loading="lazy" style="height: auto;">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                <img width="241" height="118" src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="img-fluid" alt="" loading="lazy" style="height: auto;">
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                <img width="241" height="118" src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="img-fluid" alt="" loading="lazy" style="height: auto;">
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tài trợ và đối tác
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Đối tác</a></li>
                        <li><a class="dropdown-item" href="#">Tài trợ</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">Chứng thực</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">Liên hệ</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="post" action="{{ route('search') }}">
                <div class="input-group input-group-search">
                    <button class="input-group-text bg-transparent border-0" id="header_search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="header_search">
                </div>
                {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button> --}}
            </form>
        </div>
    </div>
</nav>
{{-- 
<ul id="mega-menu-primary" class="mega-menu max-mega-menu mega-menu-horizontal">
    <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-home mega-current-menu-item mega-page_item mega-page-item-2127 mega-current_page_item mega-align-bottom-left mega-menu-flyout mega-menu-item-2132" id="mega-menu-item-2132">
        <a class="mega-menu-link" href="https://onehealth.foundation/vi/trang-chu/" tabindex="0">Trang chủ</a>
    </li>
    <li class="" id="mega-menu-item-2139">
        <a class="mega-menu-link" href="https://onehealth.foundation/vi/chung-toi-la-ai/" aria-haspopup="true" aria-expanded="false" tabindex="0">
            Chúng tôi là ai?
            <span class="mega-indicator"></span>
        </a>
        <ul class="mega-sub-menu">
            <li class="" id="mega-menu-item-2248"><a class="mega-menu-link" href="https://onehealth.foundation/vi/ban-giam-doc/">Ban Giám Đốc</a></li>
            <li class="" id="mega-menu-item-18350"><a class="mega-menu-link" href="#">Tầm nhìn</a></li>
            <li class="" id="mega-menu-item-18351"><a class="mega-menu-link" href="#">Sứ mệnh</a></li>
        </ul>
    </li>
    <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-has-children mega-menu-megamenu mega-align-bottom-left mega-menu-grid mega-menu-item-2141" id="mega-menu-item-2141">
        <a class="mega-menu-link" href="https://onehealth.foundation/vi/hoat-dong/" aria-haspopup="true" aria-expanded="false" tabindex="0">Hoạt động<span class="mega-indicator" data-has-click-event="true"></span></a>
        <ul class="mega-sub-menu">
            <li class="mega-menu-row" id="mega-menu-2141-0">
                <ul class="mega-sub-menu">
                    <li class="mega-menu-column mega-menu-columns-3-of-12" id="mega-menu-2141-0-0"></li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-has-children mega-menu-megamenu mega-align-bottom-left mega-menu-grid mega-menu-item-2071" id="mega-menu-item-2071">
        <a class="mega-menu-link" href="https://onehealth.foundation/vi/du-an/" aria-haspopup="true" aria-expanded="false" tabindex="0">Dự án<span class="mega-indicator" data-has-click-event="true"></span></a>
        <ul class="mega-sub-menu">
            <li class="mega-menu-row" id="mega-menu-2071-0">
                <ul class="mega-sub-menu">
                    <li class="mega-menu-column mega-menu-columns-3-of-12" id="mega-menu-2071-0-0">
                        <ul class="mega-sub-menu">
                            <li class="mega-menu-item mega-menu-item-type-widget widget_media_image mega-menu-item-media_image-7" id="mega-menu-item-media_image-7">
                                <a href="https://onehealth.foundation/vi/lang-thien-nguyen/">
                                    <img width="241" height="118" src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="image wp-image-2188  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;">
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mega-menu-column mega-menu-columns-3-of-12" id="mega-menu-2071-0-1">
                        <ul class="mega-sub-menu">
                            <li class="mega-menu-item mega-menu-item-type-widget widget_media_image mega-menu-item-media_image-8" id="mega-menu-item-media_image-8">
                                <a href="https://onehealth.foundation/vi/m2030-2/">
                                    <img width="241" height="118" src="https://onehealth.foundation/wp-content/uploads/2019/11/257657916.png" class="image wp-image-2187  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;">
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mega-menu-column mega-menu-columns-3-of-12" id="mega-menu-2071-0-2">
                        <ul class="mega-sub-menu">
                            <li class="mega-menu-item mega-menu-item-type-widget widget_media_image mega-menu-item-media_image-9" id="mega-menu-item-media_image-9">
                                <a href="https://onehealth.foundation/vi/trung-tam-thu-gom-rac-thai/">
                                    <img width="241" height="118" src="https://onehealth.foundation/wp-content/uploads/2019/11/plastic_bank-1.png" class="image wp-image-2190  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></a>
                            </li>
                        </ul>
                    </li>
                    <li class="mega-menu-column mega-menu-columns-3-of-12" id="mega-menu-2071-0-3">
                        <ul class="mega-sub-menu">
                            <li class="mega-menu-item mega-menu-item-type-widget widget_media_image mega-menu-item-media_image-10" id="mega-menu-item-media_image-10"><img width="200" height="118" src="https://onehealth.foundation/wp-content/uploads/2019/10/key-project-4.jpg"
                                    class="image wp-image-1949  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;"></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-align-bottom-left mega-menu-flyout mega-menu-item-2072" id="mega-menu-item-2072">
        <a class="mega-menu-link" href="#" aria-haspopup="true" aria-expanded="false" tabindex="0">Tài trợ và Đối tác<span class="mega-indicator" data-has-click-event="true"></span></a>
        <ul class="mega-sub-menu">
            <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-2073" id="mega-menu-item-2073"><a class="mega-menu-link" href="https://onehealth.foundation/vi/doi-tac/">Đối tác</a></li>
            <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-2074" id="mega-menu-item-2074"><a class="mega-menu-link" href="https://onehealth.foundation/vi/tai-tro/">Tài trợ</a></li>
        </ul>
    </li>
    <li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-align-bottom-left mega-menu-flyout mega-menu-item-18418" id="mega-menu-item-18418"><a class="mega-menu-link" href="#" tabindex="0">Chứng Thực</a></li>
    <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-align-bottom-left mega-menu-flyout mega-menu-item-2076" id="mega-menu-item-2076"><a class="mega-menu-link" href="https://onehealth.foundation/vi/lien-he/" tabindex="0">Liên hệ</a></li>
</ul> --}}
{{--
    <ul class="nav-menu d-inline">
        @foreach ($headerMenu as $value)
            @php
                $class_active = '';
            @endphp
            @if (empty($value['child']))
                <li class="{{ $class_active }}"><a href="{{ $value['link'] }}">{{ $value['label'] }}</a></li>
            @else
                <li class="chev-right {{ $class_active }}"><a href="{{ $value['link'] }}">{{ $value['label'] }}</a>
                    <ul class="child child-1">
                        @foreach ($value['child'] as $value_child)
                            @php
                                $class_active_child = '';
                            @endphp
                            @if (empty($value_child['child']))
                                <li class="{{ $class_active_child }}"><a href="{{ $value_child['link'] }}">{{ $value_child['label'] }}</a></li>
                            @else
                                <li class="chev-right {{ $class_active_child }}"><a href="{{ $value_child['link'] }}">{{ $value_child['label'] }}</a></i>
                                    <ul class="child child-2">
                                        @foreach ($value_child['child'] as $value_child_2)
                                            <li><a href="{{ $value_child_2['link'] }}">{{ $value_child_2['label'] }}</a></li>
                                        @endforeach
                                        <li><button id="btn-show-f-search" type="button" class="btn-search"><i class="fas fa-search"></i></button></li>
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach 
    </ul>
--}}
