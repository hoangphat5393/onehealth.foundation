@extends('admin.layouts.app')
@section('seo')
    @php
        $data_seo = [
            'title' => 'Setting Menu | ' . Helpers::get_option_minhnn('seo-title-add'),
            'keywords' => Helpers::get_option_minhnn('seo-keywords-add'),
            'description' => Helpers::get_option_minhnn('seo-description-add'),
            'og_title' => 'Setting Menu | ' . Helpers::get_option_minhnn('seo-title-add'),
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

@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-menu/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-menu/plugins/css/fontawesome-iconpicker.min.css') }}">

    {{-- <meta name="viewport" content="width=device-width,initial-scale=1.0"> --}}
    {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> --}}
    {{-- <link href="{{ asset('vendor/harimayco-menu/style.css') }}" rel="stylesheet"> --}}
@endpush

@section('content')
    {{-- Content Header (Page header) --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Theme Option</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Main content --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Menu</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            @include('admin.setting.menu-html')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('vendor.wmenu.scripts') --}}
@endsection


@push('scripts')
    <script>
        var menus = {
            "oneThemeLocationNoMenus": "",
            "moveUp": "Move up",
            "moveDown": "Mover down",
            "moveToTop": "Move top",
            "moveUnder": "Move under of %s",
            "moveOutFrom": "Out from under  %s",
            "under": "Under %s",
            "outFrom": "Out from %s",
            "menuFocus": "%1$s. Element menu %2$d of %3$d.",
            "subMenuFocus": "%1$s. Menu of subelement %2$d of %3$s."
        };
        var arraydata = [];
        var addcustommenur = '{{ route('haddcustommenu') }}';
        var updateitemr = '{{ route('hupdateitem') }}';
        var generatemenucontrolr = '{{ route('hgeneratemenucontrol') }}';
        var deleteitemmenur = '{{ route('hdeleteitemmenu') }}';
        var deletemenugr = '{{ route('hdeletemenug') }}';
        var createnewmenur = '{{ route('hcreatenewmenu') }}';
        var csrftoken = "{{ csrf_token() }}";
        var menuwr = "{{ url()->current() }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrftoken
            }
        });

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    </script>

    <script type="text/javascript" src="{{ asset('vendor/laravel-menu/scripts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/laravel-menu/scripts2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/laravel-menu/menu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/laravel-menu/plugins/js/fontawesome-iconpicker.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script> --}}

    <script type="text/javascript">
        $(function() {
            $('.icp-dd').iconpicker();
            $('.icp').on('iconpickerSelected', function(e) {
                $(this).parent().find('input').val(e.iconpickerValue);
                $(this).parent().find('.dropdown-menu').removeClass('show');
            });
        });

        $(function() {
            $(document).on('click', '.btn-images', function() {
                var id = $(this).attr('data');
                window.open('/file-manager/fm-button?' + id, 'fm', 'width=1200,height=600');
            });

            $('.remove-icon').click(function(event) {
                var img = $(this).data('img');
                $(this).parent().find('img').attr('src', img);
                $(this).parent().find('input[type="hidden"]').val('');
                $(this).hide();
            });
        });
        // set file link
        function fmSetLink($url, id = "preview_image") {
            const myArr = $url.split("storage/");
            document.getElementById(id).src = $url;
            document.querySelector('.' + id).value = myArr[1];
        }
    </script>
@endpush
