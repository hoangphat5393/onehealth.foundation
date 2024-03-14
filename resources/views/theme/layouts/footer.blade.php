@php
    $footerMenu = \App\Models\Menus::where('name', 'Menu-footer')->first();
@endphp

{{-- Footer Start --}}
<footer id="footer" class="site-footer py-3">
    <div class="container">
        <!--START FOOTER-->
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-3 text-center">
                    <a href="{{ route('page', 'donate') }}" class="btn btn-lg btn-warning text-white border-0 rounded-0" style="background: #ff8114;">
                        @lang('Donate now')
                    </a>
                </div>
            </div>
            <div class="footer__columns row my-4">
                @foreach ($footerMenu->items as $item)
                    <div class="col-md-6 col-lg-3 footer__column-links">
                        <h4 class="js-toggle-collapsed is-collapsed is-toggleable">{{ $item->label }}</h4>
                        <div class="menu-footer-1-tv-container">
                            <ul id="menu-footer" class="list-unstyled">
                                @foreach ($item->child as $item2)
                                    <li id="menu-item-1321" class="">
                                        <a href="{{ $item2->link }}">{{ $item2->label }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-md-6 col-lg-3 footer__column -links">
                    <h4 class="js-toggle-collapsed is-collapsed is-toggleable">Tham gia quỹ</h4>
                    <div class="menu-footer-3-tv-container">
                        <ul id="menu-footer-3-tv" class="list-unstyled">
                            <li id="menu-item-2168" class="">
                                <a href="https://onehealth.foundation/vi/quyen-gop/">Quyên góp</a>
                            </li>
                            <li id="menu-item-1328" class="">
                                <a href="https://onehealth.foundation/vi/hoc-bong/">Học Bổng</a>
                            </li>
                            <li id="menu-item-1329" class="">
                                <a href="https://onehealth.foundation/vi/tuyen-dung/">Tuyển dụng</a>
                            </li>
                            <li id="menu-item-1331" class="">
                                <a href="https://onehealth.foundation/vi/thuc-tap/">Thực tập</a>
                            </li>
                            <li id="menu-item-1332" class="">
                                <a href="https://onehealth.foundation/vi/ho-tro/">Hỗ trợ</a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-3 footer__column-social d-flex align-items-center align-items-lg-start">
                    <img src="{{ get_image(setting_option('logo_footer')) }}" class="img-fluid">
                </div>
            </div>

            <div class="row copyright justify-content-between">
                <div class="col-lg-auto">
                    <p>© 2018 OneHealth Foundation. All rights reserved.</p>
                </div>
                <div class="col-lg-auto">
                    <a href="{{ route('page', 'terms-of-service') }}" target="_blank">
                        @lang('Terms of Service')
                    </a> |
                    <a href="{{ route('page', 'privacy-policy') }}" target="_blank">
                        @lang('Privacy Policy')
                    </a>
                </div>
            </div>
        </div>
        <!--END FOOTER-->
    </div>
</footer>
