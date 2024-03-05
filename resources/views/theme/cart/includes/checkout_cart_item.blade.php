<table class="table table-borderless align-middle table-cart your-order">
    <thead>
        <tr>
            <th>YOUR ORDER</th>
            <th class="text-left">Name</th>
            <th width="20%">Price</th>
            <th>QTY</th>
            <th width="20%">Total</th>
        </tr>
    </thead>
    <tbody>
        @php $subtotal = 0; @endphp
        @foreach ($carts as $cart)
            @php
                $product = $ProductModel::find($cart->id);
                $price = product_price($product, $cart->qty);
                $subtotal += $price;
            @endphp
            <tr>
                <td>
                    @if (!empty($product->image))
                        <a class="flex-shrink-0" href="{{ route('game.detail', $product->slug) }}" title="{{ $product->name }}">
                            <img class="img-fluid item-image d-block mx-auto" src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="70">
                        </a>
                    @endif
                </td>
                <td class="text-left">{{ $product->name }}</td>
                <td>{!! render_price($cart->price) !!}</td>
                <td>{{ $cart->qty }} {{ $product->unit }}</td>
                <td style="white-space: nowrap;">$ {{ $price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"></td>
            <td>Subtotal</td>
            <td class="cart_total" style="white-space: nowrap;">{!! render_price($subtotal) !!}</td>
        </tr>
    </tbody>
</table>
