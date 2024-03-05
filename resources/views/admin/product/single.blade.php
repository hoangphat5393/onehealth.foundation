@extends('admin.layouts.app')

@php
    if (isset($product_detail)) {
        $product_info = $product_detail->getInfo;
        if ($product_info != '') {
            extract($product_info->toArray());
        }
        extract($product_detail->toArray());
        $gallery = isset($gallery) || $gallery != '' ? unserialize($gallery) : '';
    } else {
        $title_head = 'Add new product';
    }

    $title_head = $name ?? '';

    $id = $id ?? 0;

    $date_update = $updated_at ?? date('Y-m-d H:i:s');

    $spec_short = $spec_short ?? '';

@endphp

@section('seo')
    @php
        $data_seo = [
            'title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
            'og_description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_url' => Request::url(),
            'og_img' => asset('images/logo_seo.png'),
            'current_url' => Request::url(),
            'current_url_amp' => '',
        ];
        $seo = WebService::getSEO($data_seo);
    @endphp
    @include('admin.partials.seo')
@endsection

@section('content')
    {{-- Page header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title_head }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    {{-- END Page header --}}

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.productPost') }}" method="POST" id="frm-create-product" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{ $id ?? 0 }}">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ $title_head }}</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">

                                <!-- show error form -->
                                <div class="errorTxt"></div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="{{ $slug ?? '' }}">
                                            @if ($id > 0)
                                                <p><b style="color: #0000cc;">Link:</b>
                                                    <u><i><a style="color: #F00;" href="{{ route('product.detail', $slug) }}" target="_blank">{{ route('product.detail', $slug) }}</a></i></u>
                                                </p>
                                            @endif
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="type" class="title_txt col-form-label">Loại sản phẩm</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="product" {{ $type == 'product' ? 'selected' : '' }}>Sản phẩm thường</option>
                                                <option value="extra" {{ $type == 'extra' ? 'selected' : '' }}>Sản phẩm kèm theo</option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="title">Tên sản phẩm</label>
                                            <input type="text" class="form-control title_slugify" id="title" name="name" placeholder="Tiêu đề" value="{{ $name ?? '' }}">
                                        </div>
                                        <hr>
                                        @php
                                            $quote_arr = ['id' => 'description', 'label' => 'Trích dẫn', 'name' => 'description', 'description' => $description ?? ''];
                                            $content_arr = ['id' => 'content', 'label' => 'Nội dung', 'name' => 'content', 'content' => $content ?? ''];
                                        @endphp
                                        @include('admin.partials.quote', $quote_arr)
                                        @include('admin.partials.content', $content_arr)
                                    </div>
                                </div>

                                {{-- Gallery --}}
                                {{-- @include('admin.partials.galleries', ['gallery_images' => $gallery ?? '']) --}}
                                {{-- End Gallery --}}

                                <div class="form-group col-lg-6">
                                    <div class="row">
                                        <label for="sort" class="title_txt col-form-label col-md-4 px-md-1">Độ ưu tiên</label>
                                        <div class="col-md-6">
                                            <input type="text" name="sort" id="sort" value="{{ $sort ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                        @include('admin.product.includes.price_stock')
                    </div>

                    <div class="col-md-3">

                        @include('admin.partials.action_button')

                        {{-- SELECT CATEGORY --}}
                        <div class="card widget-category">
                            <div class="card-header">
                                <h4>Chuyên mục</h4>
                            </div>
                            <div class="card-body max-vh-75">
                                <div class="inside clear">
                                    @php
                                        $array_checked = isset($product_detail) ? $product_detail->categories->pluck('id')->toArray() : [];
                                        $category_type = 'product';
                                    @endphp
                                    @include('admin.partials.category-item')
                                </div>
                            </div>
                        </div>
                        {{-- END SELECT CATEGORY --}}

                        {{-- UPLOAD IMAGE --}}

                        @include('admin.partials.image', ['title' => 'Ảnh đại diện', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''])
                        {{-- @include('admin.partials.image', ['title' => 'Ảnh đại diện', 'id' => 'cover-img', 'name' => 'cover', 'image' => $cover ?? '']) --}}
                        {{-- END UPLOAD IMAGE --}}

                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->

                {{-- SEO --}}
                <div class="row">
                    <div class="col-12 col-md-9">
                        @include('admin.form-seo.seo')
                    </div>
                </div>
                {{-- END SEO --}}
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        editor('content');
        editorQuote('description');

        // auto check parrent
        $('#muti_menu_post input').each(function(index, el) {
            if ($(this).is(':checked')) {
                $(this).closest('.sub-menu').parent().find('label').first().find('input').prop('checked', true);
            }
        });

        // $('#display_price').on('focusin, focusout', function() {
        //     val = $(this).val();
        //     $('#price').val(val);
        //     total_price();
        // });

        // const total_price = () => {
        //     var price = parseFloat($('#price').val());
        //     var stock = parseFloat($('#stock').val());

        //     decimals = 2;
        //     if (price.toString().split(".").length > 1)
        //         var decimals = price.toString().split(".")[1].length;

        //     // var total_price = (parseFloat(price) * stock).toFixed(coutfixed);

        //     var total_price = number_format(price * stock, decimals, '.', ',');

        //     // console.log(arr.length);
        //     $('#total_price').val(total_price);
        // };

        // $('#price, #stock').on('change', () => {
        //     total_price();
        // });
        // total_price();


        $(function() {
            validate_form();

            function validate_form() {

                //xử lý validate
                $("#frm-create-product").validate({
                    // errorPlacement: function(error, element) {
                    //     var place = element.closest('.form-group');
                    //     if (!place.get(0)) {
                    //         place = element;
                    //     }
                    //     if (place.get(0).type === 'checkbox') {
                    //         place = element.parent();
                    //     }
                    //     if (error.text() !== '') {
                    //         place.before(error);
                    //     }
                    //     console.log(error, element)
                    // },
                    rules: {
                        name: "required",
                        // 'category_item[]': {
                        //     required: true,
                        //     minlength: 1
                        // },
                        price: {
                            required: true,
                            min: 1,
                            number: true
                        },
                        game_id: {
                            required: true
                        },
                        category_id: {
                            required: true
                        },
                    },
                    messages: {
                        name: "Enter Name",
                        'category_item[]': "Select category",
                        price: {
                            required: "Enter price",
                            min: "Enter price > 0"
                        },
                        game_id: {
                            required: "Select game"
                        },
                        category_id: {
                            required: "Select category"
                        },
                    },
                    errorElement: 'div',
                    errorLabelContainer: '.errorTxt',
                    invalidHandler: function(event, validator) {
                        $('html, body').animate({
                            scrollTop: 0
                        }, 500);
                    }
                });
            }
        });
    </script>
@endpush
