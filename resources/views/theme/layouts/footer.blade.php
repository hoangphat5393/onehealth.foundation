@php
    $lc = app()->getLocale();
    $footerMenu = \App\Models\Menus::where('name', 'Menu-footer-' . $lc)->first();
    // dd('Menu-footer-' . $lc);
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
                @empty(!$footerMenu)
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
                @endempty

                <div class="col-md-6 col-lg-3 ms-auto footer__column-social d-flex align-items-center align-items-lg-start">
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
