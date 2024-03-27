@php
    $segment_check = Request::segment(2);
    $segment_check3 = Request::segment(3);
    $menus = \App\Models\AdminMenu::getListVisible();

    $user = Auth::user();
    $user_role = Auth::user()->roles()->first();

@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <img src="{{ get_image(setting_option('logo')) }}" class="brand-image elevation-3 float-none" width="70">
        {{-- <span class="text-xs">{{ setting_option('admin-title') }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{!! __('admin.Dashboard') !!}</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('index') }}" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>{!! __('admin.Home') !!}</p>
                    </a>
                </li>

                @if (count($menus))
                    {{-- Level 0 --}}
                    @foreach ($menus[0] as $level0)
                        {{-- LEvel 1  --}}
                        @if (!empty($menus[$level0->id]) && $level0->hidden == 0)
                            <li class="nav-item has-treeview">
                                <a href="javascript:;" class="nav-link">
                                    <i class="nav-icon {{ $level0->icon }}"></i>
                                    <p>
                                        {!! __($level0->title) !!} <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($menus[$level0->id] as $level1)
                                        <li class="nav-item">
                                            <a href="{{ $level1->uri ? route($level1->uri) : '#' }}" class="nav-link {{ \App\Models\AdminMenu::checkUrlIsChild(url()->current(), route($level1->uri)) ? 'active' : '' }}">
                                                <i class="nav-icon {{ $level1->icon }}"></i>
                                                <p>{!! __($level1->title) !!}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            @if ($level0->hidden == 0)
                                <li class="nav-item">
                                    <a href="{{ $level0->uri ? route($level0->uri) : '#' }}" class="nav-link {{ \App\Models\AdminMenu::checkUrlIsChild(url()->current(), route($level0->uri)) ? 'active' : '' }}">
                                        <i class="nav-icon {{ $level0->icon }}"></i>
                                        <p>{!! __($level0->title) !!}</p>
                                    </a>
                                </li>
                            @endif
                        @endif
                        {{-- LEvel 1  --}}
                    @endforeach
                    {{-- Level 0 --}}
                @endif

                @if ($user->admin_level == '99999' && $user_role->name == 'Administrator')
                    <li class="nav-item has-treeview">
                        <a href="javascript:;" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                @lang('admin.Users')<i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.userList') }}" class="nav-link">
                                    <i class="nav-icon fas fa-angle-right"></i>
                                    <p> @lang('admin.All Users') </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roleList') }}" class="nav-link ">
                                    <i class="nav-icon fas fa-angle-right"></i>
                                    <p>@lang('Permission group')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.permissionList') }}" class="nav-link ">
                                    <i class="nav-icon fas fa-angle-right"></i>
                                    <p>@lang('Permission')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                {{-- Setting --}}
                <li class="nav-header">Setting</li>
                {{-- @if ($user_role->name == 'Administrator')
                    <li class="nav-item">
                        <a href="{{ route('admin.themeOption') }}" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            Theme Option
                        </a>
                    </li>
                @endif --}}

                <li class="nav-item">
                    <a href="{{ route('admin.themeOption') }}" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Theme Option</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.changePassword') }}" class="nav-link">
                        <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                        <p>@lang('admin.Account')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>@lang('admin.Logout')</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
