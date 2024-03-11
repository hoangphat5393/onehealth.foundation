<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ setting_option('favicon') }}" />

    @yield('seo')

    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}

    <!-- Font Awesome 6.4.2 -->
    <link rel="stylesheet" href="{{ asset('fontawesome_pro/css/all.min.css') }}">

    {{-- ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- AdminLTE v3.2.0 Css -->
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css?ver=' . time()) }}">

    <link rel="stylesheet" href="{{ asset('plugin/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    {{-- https://gitbrent.github.io/bootstrap4-toggle/ --}}
    <link rel="stylesheet" href="{{ asset('plugin/bootstrap4-toggle/bootstrap4-toggle.min.css') }}">

    {{-- Jquery UI --}}
    <link rel="stylesheet" href="{{ asset('plugin/jquery-ui/jquery-ui.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugin/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">

    <!-- Admin Custom Css -->
    <link rel="stylesheet" href="{{ asset('css/style_admin.css?ver=' . time()) }}">

    @stack('style')

    @stack('head-script')



</head>

<body>
    @include('admin.layouts.header')

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('index') }}" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('admin.layouts.sidebar')

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">
            @yield('content')
        </div>
        {{-- content-wrapper --}}
    </div>

    @include('admin.layouts.footer')

    <!-- Main js -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.2/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugin/axios.min.js') }}"></script>
    <script src="{{ asset('plugin/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/js/adminlte.js?ver=' . time()) }}"></script>

    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>

    <script src="{{ asset('plugin/moment.min.js') }}"></script>
    <script src="{{ asset('plugin/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('plugin/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugin/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>

    {{-- https://gitbrent.github.io/bootstrap4-toggle/ --}}
    <script src="{{ asset('plugin/bootstrap4-toggle/bootstrap4-toggle.min.js') }}"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/js_admin.js?ver=' . time()) }}"></script>

    <script>
        CKEDITOR.editorConfig = function(config) {
            config.pasteFromWordPromptCleanup = true;
            config.pasteFromWordRemoveFontStyles = false;
            config.pasteFromWordRemoveStyles = false;
            // config.extraPlugins = 'imagepaste';
            // config.extraPlugins = 'tab';
            // config.removePlugins = 'resize';
            // config.resize_enabled = false;
            // config.disableObjectResizing = true;
        };

        CKFinder.config({
            connectorPath: '/ckfinder/connector',
        });
    </script>

    {{-- URL --}}
    <script type="text/javascript">
        var admin_url = '{{ route('admin.dashboard') }}';
    </script>

    @stack('scripts')

    @stack('scripts-footer')

</body>

</html>
