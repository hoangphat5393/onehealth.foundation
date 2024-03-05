@extends($templatePath . '.layouts.index2')
@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@php
    $gallery = '';
    if (isset($product)) {
        extract($product->toArray());
        $gallery = isset($gallery) || $gallery != '' ? unserialize($gallery) : '';
    }

    // dd($product);

@endphp

@section('body-class', 'archive post-type-archive post-type-archive-product wp-custom-logo theme-amaya woocommerce-shop woocommerce woocommerce-page woocommerce-js shop nomobile product-title-use-headline-font content-light')

@section('content')
    <div id="content" class="site-content">
        <main id="main" class="site-main">
            <div class="container">
                <div id="product-405" class="row">
                    <div class="col-lg-6">
                        <div data-thumb="{{ get_image($product->image) }}" class="woocommerce-product-gallery__image">
                            <a href="{{ get_image($product->image) }}">
                                {{-- <img class="wp-post-image img-fluid" width="870" height="1217" src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-01.jpg" alt=""> --}}
                                <img class="img-fluid" src="{{ get_image($product->image) }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 summary entry-summary">
                        <h1 class="product_title entry-title">{{ $product->name }}</h1>
                        <p class="price">
                            <span class="woocommerce-Price-amount amount">
                                {{ number_format($product->price, '2', '.', ',') }}
                                <span class="woocommerce-Price-currencySymbol">{{ $product->unit }}</span>
                            </span>

                        </p>
                        <div class="woocommerce-product-details__short-description">
                            {!! htmlspecialchars_decode($product->description) !!}
                        </div>
                        <form class="variations_form cart" action="" method="post" enctype="multipart/form-data" data-product_id="405" current-image="">
                            {{-- <table class="variations" cellspacing="0" role="presentation">
                                <tbody>
                                    <tr>
                                        <th class="label"><label for="size">Size</label></th>
                                        <td class="value"> <select id="size" class="" name="attribute_size" data-attribute_name="attribute_size" data-show_option_none="yes">
                                                <option value="">Choose an option</option>
                                                <option value="500g" selected="selected" class="attached enabled">500g</option>
                                                <option value="800g" class="attached enabled">800g</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="label"><label for="roast">Roast</label></th>
                                        <td class="value"> <select id="roast" class="" name="attribute_roast" data-attribute_name="attribute_roast" data-show_option_none="yes">
                                                <option value="">Choose an option</option>
                                                <option value="Whole Bean" class="attached enabled">Whole Bean</option>
                                                <option value="Mild Roast" class="attached enabled">Mild Roast</option>
                                                <option value="Dark Roast" class="attached enabled">Dark Roast</option>
                                            </select>
                                            <a class="reset_variations" href="#">Clear</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}
                            <div class="single_variation_wrap">
                                {{-- <div class="woocommerce-variation single_variation" style="">
                                    <div class="woocommerce-variation-description"></div>
                                    <div class="woocommerce-variation-price"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>19.00</bdi></span></span></div>
                                    <div class="woocommerce-variation-availability">
                                        <p class="stock in-stock">3 in stock</p>
                                    </div>
                                </div> --}}
                                <div class="woocommerce-variation-add-to-cart variations_button woocommerce-variation-add-to-cart-disabled">
                                    <div class="quantity">
                                        <label class="screen-reader-text" for="quantity_659270f203d4b">Colombia Dark Roast quantity</label>
                                        <input type="number" id="quantity_659270f203d4b" class="input-text qty text" name="quantity" value="1" aria-label="Product quantity" size="4" min="1" max="3" step="1" placeholder="" inputmode="numeric" autocomplete="off">
                                    </div>
                                    <button type="submit" class="single_add_to_cart_button button alt disabled wc-variation-selection-needed">Add to cart</button>
                                    <input type="hidden" name="add-to-cart" value="405"> <input type="hidden" name="product_id" value="405"> <input type="hidden" name="variation_id" class="variation_id" value="0">
                                </div>
                            </div>
                        </form>
                        <div class="product_meta"> <span class="sku_wrapper">SKU: <span class="sku">N/A</span></span> <span class="posted_in">Category: <a href="https://www.amayatheme.redsun.design/roastery/product-category/coffee/" rel="tag">coffee</a></span></div>
                    </div>

                    <div class="woocommerce-tabs wc-tabs-wrapper">
                        <ul class="tabs wc-tabs" role="tablist">
                            <li class="additional_information_tab active" id="tab-title-additional_information" role="tab" aria-controls="tab-additional_information">
                                <a href="#tab-additional_information"> Thông tin sản phẩm </a>
                            </li>
                        </ul>
                        <div class="" id="tab-additional_information" role="tabpanel" aria-labelledby="tab-title-additional_information" style="">
                            {!! htmlspecialchars_decode($product->content) !!}
                        </div>
                    </div>

                    <section class="related products">
                        <h2>Related products</h2>
                        <ul class="products columns-4">
                            <li class="product type-product post-431 status-publish first instock product_cat-coffee has-post-thumbnail shipping-taxable purchasable product-type-variable has-default-attributes"> <a href="https://www.amayatheme.redsun.design/roastery/product/french-roast/"
                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><img width="600" height="839" src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-600x839.jpg"
                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async"
                                        srcset="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-600x839.jpg 600w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-214x300.jpg 214w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-732x1024.jpg 732w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-768x1074.jpg 768w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-800x1119.jpg 800w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03-560x783.jpg 560w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-bag-03.jpg 870w"
                                        sizes="(max-width: 600px) 100vw, 600px">
                                    <h2 class="woocommerce-loop-product__title">French Roast</h2> <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>19.00</bdi></span> – <span class="woocommerce-Price-amount amount"><bdi><span
                                                    class="woocommerce-Price-currencySymbol">$</span>27.00</bdi></span></span>
                                </a>

                            </li>
                            <li class="product type-product post-417 status-publish instock product_cat-coffee has-post-thumbnail shipping-taxable purchasable product-type-variable has-default-attributes"> <a href="https://www.amayatheme.redsun.design/roastery/product/breakfast-blend/"
                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><img width="600" height="839" src="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-600x839.jpg"
                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async"
                                        srcset="https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-600x839.jpg 600w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-214x300.jpg 214w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-732x1024.jpg 732w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-768x1074.jpg 768w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-800x1119.jpg 800w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04-560x783.jpg 560w, https://www.amayatheme.redsun.design/roastery/wp-content/uploads/sites/2/2020/08/coffee-04.jpg 870w"
                                        sizes="(max-width: 600px) 100vw, 600px">
                                    <h2 class="woocommerce-loop-product__title">Breakfast Blend</h2> <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>19.00</bdi></span> – <span
                                            class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>27.00</bdi></span></span>
                                </a>

                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    {{-- testmail@gmail.com --}}
    <script>
        // LOGIN
        $('.login-btn').on('click', function(e) {
            e.preventDefault();
            var username = $('input[name="username"]').val();
            var password = $('input[name="password"]').val();
            // var email = $('#lg_email').val();
            var redirect = $('input[name="url_redirect"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    url: 'ajax/customer/login',
                    type: 'post',
                    data: {
                        username: username,
                        password: password,
                        // email: email
                    },
                })
                .done(function(data) {
                    console.log(data, redirect);
                    $('.error-login-customer').text(data.error_login);
                    $('.error-login-customer').css('display', 'block');
                    if (data.status_login == true) {
                        // location.reload();
                        window.location.replace(redirect);
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function(data) {
                    console.log(data);
                });
        });
    </script>

    <script>
        // splide.mount();
        document.addEventListener('DOMContentLoaded', function() {

            if ($(".main-slider")[0]) {
                var main = new Splide('.main-slider', {
                    type: 'fade',
                    rewind: true,
                    pagination: false,
                    arrows: false,
                });
                main.mount();
            }

            if ($(".thumbnail-slider")[0]) {
                var thumbnails = new Splide('.thumbnail-slider', {
                    gap: 8,
                    rewind: true,
                    pagination: false,
                    isNavigation: true,
                    arrows: true,
                    perPage: 4,
                    breakpoints: {
                        576: {
                            perPage: 3,
                        },
                    },
                });
                thumbnails.mount();
                main.sync(thumbnails);
            }
        });
    </script>

    <script>
        $(".gallery-thumb-item").on("click", function(e) {
            $([document.documentElement, document.body]).animate({
                    scrollTop: $("#img-detail-product").offset().top,
                },
                200
            );
        });
    </script>
@endpush
