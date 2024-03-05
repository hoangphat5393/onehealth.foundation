@extends('theme.layouts.index2')
@section('seo')
    @include($templatePath . '.layouts.seo', $seo ?? [])
@endsection


{{-- @php
    dd($categories, $category);
@endphp --}}

@section('body-class', 'archive post-type-archive post-type-archive-product wp-custom-logo theme-amaya woocommerce-shop woocommerce woocommerce-page woocommerce-js shop nomobile product-title-use-headline-font content-light')


@section('content')
    <div id="content" class="site-content">
        <h1 class="page-title">Shop</h1>
        <div class="container">
            <div id="primary" class="content-area ">
                <main id="main" class="site-main">
                    <div id="woocommerce-content" class="content product-title-use-headline-font single-product-title-use-headline-font cartlink-hover">
                        <div class="page-content">
                            <div class="product-categories-list use-body-font">
                                <div class="product-categories-list-all"> <a href="{{ route('page', 'product') }}"> Tất cả </a></div>
                                <div class="product-categories-list-select">
                                    <div class="woocommerce columns-4">
                                        @if ($categories->count() > 0)
                                            <ul class="products columns-4">
                                                @foreach ($categories as $item)
                                                    <li @class([
                                                        'product-category product ',
                                                        'first' => $loop->iteration == 1,
                                                    ])>
                                                        <a aria-label="Visit product category coffee" href="{{ route('product.detail', $item->slug) }}">
                                                            <h2 class="woocommerce-loop-category__title"> {{ $item->name }} <mark class="count">(6)</mark></h2>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="woocommerce-notices-wrapper"></div>
                            <form class="woocommerce-ordering" method="get">
                                <select name="orderby" class="orderby" aria-label="Shop order">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select> <input type="hidden" name="paged" value="1">
                            </form>
                            <ul class="products columns-4">
                                @foreach ($product as $item)
                                    <li class="product type-product post-405 status-publish first instock product_cat-coffee has-post-thumbnail shipping-taxable purchasable product-type-variable has-default-attributes">
                                        <a href="{{ route('product.detail', $item->slug) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            <img width="600" height="839" src="{{ get_image($item->image) }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" fetchpriority="high">
                                            <h2 class="woocommerce-loop-product__title">
                                                {{ $item->name }}
                                            </h2>
                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    {{ number_format($item->price, 2, '.', ',') }} <span class="woocommerce-Price-currencySymbol">{{ $item->unit }}</span>
                                                </span>
                                            </span>
                                        </a>
                                        {{-- <a href="{{ route('product.detail', $item->slug) }}" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="405" data-product_sku="" aria-label="Select options for “Colombia Dark Roast”"
                                            aria-describedby="This product has multiple variants. The options may be chosen on the product page" rel="nofollow">Select options</a> --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="nav-pagination">
                            {{ $product->links('theme.pagination.custom') }}
                            {{-- {{ $news->links() }} --}}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush
