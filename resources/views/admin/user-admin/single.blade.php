@extends('admin.layouts.app')
@php
    if (isset($data_admin)) {
        extract($data_admin->toArray());
        // if ($gallery) {
        //     $gallery = unserialize($gallery);
        // }
    }

    $title_head = $name ?? __('Add administrators');

    $id = $id ?? 0;
    // $name = isset($data_admin) && !empty($data_admin) ? $data_admin->name : '';
    // $email = isset($data_admin) && !empty($data_admin) ? $data_admin->email : '';

    $date_update = $updated_at ?? date('Y-m-d H:i:s');
    // $admin_level = $admin_level ?? 1;

    // dd($data_admin, $all_roles);
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title_head }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.postUserAdmin') }}" method="POST" id="frm-create-useradmin" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $title_head }}</h4>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                @if (count($errors) > 0)
                                    <div class="alert-tb alert alert-danger">
                                        @foreach ($errors->all() as $err)
                                            <i class="fa fa-exclamation-circle"></i> {{ $err }}<br />
                                        @endforeach
                                    </div>
                                @endif
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="name">@lang('admin.Name')</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin.Name')" value="{{ old('name', $name ?? '') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="post_title">@lang('admin.Email')</label>
                                            <input type="text" class="form-control title_slugify" id="post_title" name="email" placeholder="@lang('admin.Email')" value="{{ old('email', $email ?? '') }}">
                                        </div>

                                        @if ($id)
                                            <div class="form-group">
                                                <label for="check_pass">@lang('admin.Change password?')</label>
                                                <input type="checkbox" name="check_pass" id="check_pass" value="1">
                                            </div>
                                        @endif
                                        <div class="wrap-pass" {{ $id == 0 ? 'style=display:block' : '' }}>
                                            <div class="form-group">
                                                <label for="password">@lang('admin.Password')</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('admin.Password')" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="repassword">@lang('admin.Password_confirmation')</label>
                                                <input type="password" class="form-control" id="repassword" name="password_confirmation" placeholder="@lang('admin.Password_confirmation')" autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            @php
                                                $listRoles = [];
                                                if (isset($user_roles) && is_array($user_roles)) {
                                                    foreach ($user_roles as $value) {
                                                        $listRoles[] = (int) $value;
                                                    }
                                                }
                                            @endphp
                                            <label for="post_description">@lang('admin.Roles')</label>
                                            <select name="roles[]" multiple class="form-control select2">
                                                {{-- <option value=""></option> --}}
                                                @if (isset($all_roles) && is_array($all_roles))
                                                    @foreach ($all_roles as $k => $v)
                                                        <option value="{{ $k }}" {{ count($listRoles) && in_array($k, $listRoles) ? 'selected' : '' }}>{{ $v }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <input type="hidden" class="form-control title_slugify" id="admin_level" name="admin_level" placeholder="" value="{{ old('admin_level', $admin_level ?? 1) }}">
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div> <!-- /.col-9 -->
                    <div class="col-3">
                        @include('admin.partials.action_button')
                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->
            </form>
        </div> <!-- /.container-fluid -->
    </section>

@endsection
@push('styles')
    <style>
        .wrap-pass {
            display: none;
        }

        .avtive-wpap-pass {
            display: block;
        }

        #frm-create-useradmin .error {
            color: #dc3545;
            font-size: 13px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            //xử lý validate
            $("#frm-create-useradmin").validate({
                rules: {
                    email: {
                        required: true,
                        // email: true
                    },
                    name: "required",
                    password: "required",
                    repassword: {
                        equalTo: "#password"
                    },
                },
                messages: {
                    email: {
                        required: "Vui lòng nhập Email",
                        // email: "Email không hợp lệ"
                    },
                    name: "Nhập tên nhân viên",
                    password: "Nhập mật khẩu",
                    repassword: "Mật khẩu không chính xác",
                },

                // errorElement : 'div',
                // errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });

            //check change pass
            $('input[name="check_pass"]').click(function() {
                $('.wrap-pass').toggleClass('avtive-wpap-pass');
            });
        });
    </script>
@endpush
