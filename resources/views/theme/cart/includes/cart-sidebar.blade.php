@php
    $subtotal = 0;
    $auth_discount = 0;
    foreach ($carts as $cart) {
        $price = 0;
        $product = $ProductModel::find($cart->id);
        $price = product_price($product, $cart->qty);
        $subtotal += $price;
    }
    // $total = Cart::total(2);
    
    if (auth()->check()) {
        $auth_discount = ($subtotal * setting_cost('auth_discount')) / 100;
    }
@endphp
<div class="col-12 col-lg-4 pt-sm-4 pt-md-3">
    <div class="cart-total bdr sticky-top">
        <div class="heading">CART TOTAL</div>
        <div class="body">
            {{-- <div class="mb-2 into-subtotal">
                <div class="d-flex justify-content-between">
                    <div>Subtotal:</div>
                    <div class="subtotal">
                        {!! render_price($subtotal) !!}
                    </div>
                </div>
            </div> --}}
            {{-- @if ($auth_discount)
                <input type="hidden" id="auth_discount" name="auth_discount" value="{{ setting_cost('auth_discount') }}">
                <div class="mb-2">
                    <div class="d-flex justify-content-between">
                        <div>VIP Discount ({{ setting_cost('auth_discount') }}%):</div>
                        <div class="auth_discount_price">
                            {!! render_price($auth_discount) !!}
                        </div>
                    </div>
                </div>
            @endif --}}
            <div class="mb-3 pb-3 into-money">
                <div class="d-flex justify-content-between">
                    <div class="subtotal text-uppercase">Subtotal:</div>
                    <div class="subtotal ordertotal">
                        {{-- {!! render_price($subtotal - $auth_discount) !!} --}}
                        {!! render_price($subtotal) !!}
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-checkout d-block w-100 mt-3 submit-confirm" type="button">
                <img src="{{ asset($templateFile . '/images/icon-lock.svg') }}" alt=""> CHECKOUT
            </button>
        </div>
    </div>
</div>
