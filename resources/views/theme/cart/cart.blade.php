@extends($templatePath . '.layouts.index')

@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection

@inject('ProductModel', 'App\Product')

@section('content')
    <div class="carts-content">
        <div class="cart_bg">
            <div class="container pt-4 pb-3 py-sm-4">
                <div class="breadcrumbs my-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ol>
                </div>

                @if ($carts->count())
                    <div class="row">
                        <div class="col-12 col-lg-8 pt-sm-3">
                            <form class="needs-validation" action="{{ route('cart.checkout') }}" method="post" id="form-checkout">
                                @csrf()
                                <input type="hidden" name="shipping_cost" value="0">
                                <input type="hidden" name="cart_total" value="{{ Cart::total(2) }}" data-origin="{{ Cart::total(2) }}">
                                <input type="hidden" name="res_token" id="res_token" value="">

                                {{-- CART TABLE --}}
                                <div class="table-container bdr mb-4">
                                    <div class="table-responsive cart-table-include">
                                        @include($templatePath . '.cart.cart-table')
                                    </div>
                                </div>

                                {{-- PAYMENT METHOD --}}
                                {{-- @include($templatePath . '.cart.includes.payment-method') --}}
                            </form>
                            {{-- @include($templatePath . '.cart.includes.customer-info') --}}
                        </div>

                        {{-- SIDEBAR --}}
                        @include($templatePath . '.cart.includes.cart-sidebar')
                        {{-- END SIDEBAR --}}
                    </div>
                @else
                    <div class="alert alert-dark text-uppercase mt-5" role="alert">
                        <i class="ci-loudspeaker"></i> &nbsp;@lang('Cart is empty!')
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('after-footer')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset($templateFile . '/js/cart.js?ver=' . time()) }}"></script>

    <script>
        jQuery(document).ready(function($) {
            $('input[name="delivery"]:checked').parent().find('.ship-content').show();
            $('input[name="payment_method"]:checked').parent().find('.payment-content').show();

            $('input[name="payment_method"]').on('change', function() {
                $('.payment-content').hide();
                $(this).parent().find('.payment-content').show();
            });

            $('input[name="delivery"]').on('change', function() {
                $('.ship-content').hide();
                $(this).parent().find('.ship-content').show();
                var val = $(this).val();
                $('.delivery_content').hide();
                $('.' + val + '_content').show();
                if (val == 'pick_up') {
                    $('.get_shipping_cost').hide();
                    $('.submit-checkout').show();
                    $('.shipping_cost').text(0);
                    $('.cart_total').html('{!! render_price(Cart::total(2)) !!}');
                    $('input[name="cart_total"]').val('{{ Cart::total(2) }}');
                } else {
                    $('.get_shipping_cost').show();
                    $('.submit-checkout').hide();
                    $('.shipping_cost').text('Calculated at next step');
                }
            });


            $(document).on('change', '.shipping-list input', function() {
                var price = $(this).val();
                var total = $('input[name="cart_total"]').data('origin');

                $('.shipping_cost').text('$' + price);
                $('input[name="shipping_cost"]').val(price);

                total = parseFloat(total) + parseFloat(price);
                $('.cart_total').text('$' + total);
                $('input[name="cart_total"]').val(total);
            });
        });
    </script>

    <script>
        $(document).on('click', '.cart__remove', function(event) {
            event.preventDefault();
            $(this).closest('.cart__row_item').remove();
            var rowId = $(this).attr('data');
            axios({
                method: 'post',
                url: '/cart/ajax/remove',
                data: {
                    rowId: rowId
                }
            }).then(res => {
                if (res.data.error == 0) {
                    setTimeout(function() {
                        $('#CartCount').html(res.data.count_cart);
                        $('#header-cart .total .money').html(res.data.total);
                    }, 1000);
                    alertJs('success', res.data.msg);
                } else {
                    alertJs('error', res.data.msg);
                }
            }).catch(e => console.log(e));
        });

        $(document).on('change', '.quantity1', function() {

            var qty = $(this).val(),
                rowId = $(this).data('rowid');

            if (qty > 0) {
                axios({
                    method: 'post',
                    url: '{{ route('carts.update') }}',
                    data: {
                        rowId: rowId,
                        qty: qty
                    }
                }).then(res => {
                    if (res.data.error == 0) {
                        // $('.carts-content').html(res.data.view);

                        // Update cart table
                        $('.carts-content .cart-table-include').html(res.data.view);

                        // Update header cart
                        setTimeout(function() {
                            $('#CartCount').html(res.data.count_cart);
                            $('.site-cart #header-cart').remove();
                            $('.site-cart').append(res.data.view_cart_mini);
                            $(".site-cart").find("#header-cart").addClass("d-block");

                            let subtotal = res.data.subtotal;
                            // let auth_discount = parseFloat($('input[name="auth_discount"]').val());
                            // let total = subtotal * (100 - auth_discount) / 100;
                            // let auth_discount_price = number_format((subtotal * auth_discount) / 100, 2, '.', ',');
                            // // console.log(subtotal, auth_discount, total);
                            // $('.into-subtotal .subtotal').html('$ ' + subtotal);
                            // $('.auth_discount_price').html('$ ' + auth_discount_price);
                            // $('.into-money .ordertotal').html('$ ' + number_format(total, 2, '.', ','));
                            $('.into-money .ordertotal').html('$ ' + number_format(subtotal, 2, '.', ','));

                            setTimeout(function() {
                                $(".site-cart").find("#header-cart").removeClass("d-block");
                            }, 1000);

                        }, 1000);

                        alertJs('success', res.data.msg);

                    } else {
                        alertJs('error', res.data.msg);
                    }
                }).catch(e => console.log(e));
            }
        })
    </script>
@endpush
