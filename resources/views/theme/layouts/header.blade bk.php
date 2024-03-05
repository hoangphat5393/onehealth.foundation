@php
// if (Auth::check()) {
// $user = Auth::user();
// $avatar = public_path('img/users/avatar/') . $user->avatar;
// }
@endphp

<div class="topbar mobile-non-sticky">
    <div class="topbar-content center not-wrapped">
        <div class="topbar-left" style="width: 148.011px;"></div>
        <div class="topbar-center aos-init aos-animate" data-aos="fade" data-aos-duration="0">
            <div class="topbar-text-wrap use-body-font">
                <div class="topbar-text topbar-more">free shipping on orders of $35+</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="social-wrap">
                <ul class="socialicons">
                    <li><a href="#" target="_blank"> <i aria-hidden="true" class="fab fa-instagram"></i> <span class="screen-reader-text">instagram</span> </a></li>
                    <li><a href="#" target="_blank"> <i aria-hidden="true" class="fab fa-facebook-f"></i> <span class="screen-reader-text">facebook-f</span> </a></li>
                </ul>
            </div>
            <div class="cart-icon-wrap">
                <a class="cart-contents" href="{{ route('cart') }}" title="View your shopping cart">
                    {{-- <i class="fa-regular fa-cart-shopping"></i> --}}
                    <span class="cart-contents-count">2</span>
                </a>
            </div>
            <div class="searchbutton">
                <div class="search-icon-wrap">
                    <a href="#">
                        <i class="icon-search fa fa-search"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<header id="header" class="site-header stickytop mobile-non-sticky">
    <div id="header-regular" class="header1 navi-items-space-between socialpos-h2-topbar searchpos-h2-topbar cartpos-h2-topbar  ">
        <div class="header-wrap">
            <div class="header-wrap2">
                <div class="spaceholder"></div>
                <div class="nav-wrap">
                    <nav id="site-navigation" class="main-navigation use-body-font" data-leftitems="4">
                        <ul class="primary-menu menu-logo-centered aos-init aos-animate" data-leftitems="4" data-aos="fade" data-aos-duration="0">
                            <li class="menu-item-logo" style="padding-left: 40.906px;">
                                <div class="logowrap  logo-img">
                                    <h3 class="site-title site-logo">
                                        <a href="{{ route('index') }}" rel="home">
                                            {{-- <img src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2021/01/Amaya-logo.png" class="logoimage" width="212" height="88" alt="Amaya Roastery"> --}}
                                            <img src="{{ get_image(setting_option('logo')) }}" class="logoimage" alt="{{ setting_option('admin-title') }}" style="height:88px">
                                        </a>
                                    </h3>
                                </div>
                            </li>
                            <li id="menu-item-3728" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-3728">
                                <a href="{{ route('index') }}">Trang chủ</a>
                                {{-- <i class="chevron-down"></i>
                                <ul class="sub-menu">
                                    <li id="menu-item-3741" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3741"><a href="https://www.amayatheme.redsun.design/roastery/home-2/">Home 2</a></li>
                                    <li id="menu-item-3746" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3746"><a href="https://www.amayatheme.redsun.design/roastery/home-3/">Home 3</a></li>
                                    <li id="menu-item-3747" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3747"><a href="https://www.amayatheme.redsun.design/roastery/home-4/">Home 4</a></li>
                                    <li id="menu-item-3742" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3742"><a href="https://www.amayatheme.redsun.design/roastery/home-5/">Home 5</a></li>
                                    <li id="menu-item-3745" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3745"><a href="https://www.amayatheme.redsun.design/roastery/home-6/">Home 6</a></li>
                                    <li id="menu-item-4313" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4313"><a href="https://www.amayatheme.redsun.design/coffeebar">Demo 2</a></li>
                                    <li id="menu-item-4325" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4325"><a href="https://www.amayatheme.redsun.design/dark/">New: Demo 3 (Dark Skin)</a></li>
                                </ul> --}}
                            </li>

                            <li id="menu-item-3738" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3738">
                                <a href="{{ route('setup') }}">Dịch vụ Setup</a>
                            </li>

                            @php
                            $categories = \App\Models\Category::where('status', 1)
                            ->where('type', 'product')
                            ->get();
                            @endphp
                            <li id="menu-item-4127" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4127">
                                <a href="{{ route('page', 'product') }}">Sản phẩm</a>
                                {{-- <i class="chevron-down"></i> --}}

                                @if ($categories->count() > 0)
                                <ul class="sub-menu">
                                    @foreach ($categories as $item)
                                    <li id="menu-item-4128" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4128">
                                        <a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>

                            <li id="menu-item-3729" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3729">
                                <a href="{{ route('page', 'news') }}">Tin tức</a>
                                {{-- <i class="chevron-down"></i>
                                <ul class="sub-menu">
                                    <li id="menu-item-3750" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3750"><a href="https://www.amayatheme.redsun.design/roastery/advanced-espresso-brewing/">Regular Post with Sidebar</a></li>
                                    <li id="menu-item-3751" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3751"><a href="https://www.amayatheme.redsun.design/roastery/professional-latte-art-class/">Sidebar below Title</a></li>
                                    <li id="menu-item-3749" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3749"><a href="https://www.amayatheme.redsun.design/roastery/how-to-brew-coffee-like-a-barrista/">Sidebar below Featured Image</a></li>
                                    <li id="menu-item-3748" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3748"><a href="https://www.amayatheme.redsun.design/roastery/meeting-a-farmer-family-in-the-mountains-of-peru/">wide image with overlay text</a></li>
                                </ul> --}}
                            </li>

                            {{-- <li id="menu-item-3738" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3738">
                                <a href="#">Giỏ hàng</a>
                            </li>

                            <li id="menu-item-3738" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3738">
                                <a href="{{ route('contact') }}">Liên hệ</a>
                            </li> --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div id="header-responsive">
        <div class="header-wrap">
            <div class="header-top">
                <div class="header-left">
                    <div class="toggle-wrap">
                        <div id="toggle">
                            <div class="bar"></div>
                        </div>
                    </div>
                </div>
                <div class="header-center">
                    <div class="logowrap logo-img">
                        <h3 class="site-title site-logo">
                            <a href="https://www.amayatheme.redsun.design/roastery/" rel="home">
                                <img src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2021/01/Amaya-logo.png" class="logoimage" width="212" height="88" alt="Amaya Roastery">
                            </a>
                        </h3>
                    </div>
                </div>
                <div class="header-right">
                    <div class="searchbutton">
                        <div class="search-icon-wrap">
                            <a href="#"> <i class="icon-search fa fa-search"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navi-wrap-responsive">
            <section id="navi-overlay">
                <nav>
                    <div class="menu-main-menu-container">
                        <ul id="menu-main-menu-1" class="responsive-menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-3728 open"><a href="{{ route('index') }}">Home</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3741"><a href="https://www.amayatheme.redsun.design/roastery/home-2/">Home 2</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3746"><a href="https://www.amayatheme.redsun.design/roastery/home-3/">Home 3</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3747"><a href="https://www.amayatheme.redsun.design/roastery/home-4/">Home 4</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3742"><a href="https://www.amayatheme.redsun.design/roastery/home-5/">Home 5</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3745"><a href="https://www.amayatheme.redsun.design/roastery/home-6/">Home 6</a></li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4313"><a href="https://www.amayatheme.redsun.design/coffeebar">Demo 2</a></li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4325"><a href="https://www.amayatheme.redsun.design/dark/">New: Demo 3 (Dark Skin)</a></li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-3714 open"><a href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1305 current_page_item menu-item-3740"><a href="https://www.amayatheme.redsun.design/roastery/about/" aria-current="page">About</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3739"><a href="https://www.amayatheme.redsun.design/roastery/faq/">FAQ</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3737"><a href="https://www.amayatheme.redsun.design/roastery/custom-blocks/">Custom Blocks</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3731"><a href="https://www.amayatheme.redsun.design/roastery/menu-examples/">Menu Examples</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3744"><a href="https://www.amayatheme.redsun.design/roastery/content-boxes-examples/">Content Boxes Examples</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3743"><a href="https://www.amayatheme.redsun.design/roastery/recommended-and-supported-plugins/">Recommended and Supported Plugins</a></li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3729 open"><a href="https://www.amayatheme.redsun.design/roastery/articles/">Articles</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3750"><a href="https://www.amayatheme.redsun.design/roastery/advanced-espresso-brewing/">Regular Post with Sidebar</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3751"><a href="https://www.amayatheme.redsun.design/roastery/professional-latte-art-class/">Sidebar below Title</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3749"><a href="https://www.amayatheme.redsun.design/roastery/how-to-brew-coffee-like-a-barrista/">Sidebar below Featured Image</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3748"><a href="https://www.amayatheme.redsun.design/roastery/meeting-a-farmer-family-in-the-mountains-of-peru/">wide image with overlay text</a></li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3738"><a href="https://www.amayatheme.redsun.design/roastery/wholesale/">Wholesale</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4127 open"><a href="https://www.amayatheme.redsun.design/roastery/shop/">Shop</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4128"><a href="https://www.amayatheme.redsun.design/roastery/cart/">Cart</a></li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3730"><a href="https://www.amayatheme.redsun.design/roastery/locations/">Locations</a></li>
                        </ul>
                    </div>
                </nav>
            </section>
        </div>
    </div>
</header>