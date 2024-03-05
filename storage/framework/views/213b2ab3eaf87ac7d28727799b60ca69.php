<?php
    $segment_check = Request::segment(2);
    $segment_check3 = Request::segment(3);
    $menus = \App\Models\AdminMenu::getListVisible();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link text-center">
        <img src="<?php echo e(get_image(setting_option('logo'))); ?>" class="brand-image elevation-3" width="70">
        <span class="text-xs"><?php echo e(setting_option('admin-title')); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="<?php echo e(route('index')); ?>" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Xem trang chủ</p>
                    </a>
                </li>

                <?php if(count($menus)): ?>
                    
                    <?php $__currentLoopData = $menus[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level0): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if(!empty($menus[$level0->id]) && $level0->hidden == 0): ?>
                            <li class="nav-item has-treeview">
                                <a href="javascript:;" class="nav-link">
                                    <i class="nav-icon <?php echo e($level0->icon); ?>"></i>
                                    <?php echo __($level0->title); ?> <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php $__currentLoopData = $menus[$level0->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e($level1->uri ? route($level1->uri) : '#'); ?>" class="nav-link <?php echo e(\App\Models\AdminMenu::checkUrlIsChild(url()->current(), route($level1->uri)) ? 'active' : ''); ?>">
                                                <i class="nav-icon <?php echo e($level1->icon); ?>"></i>
                                                <?php echo __($level1->title); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <?php if($level0->hidden == 0): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e($level0->uri ? route($level0->uri) : '#'); ?>" class="nav-link <?php echo e(\App\Models\AdminMenu::checkUrlIsChild(url()->current(), route($level0->uri)) ? 'active' : ''); ?>">
                                        <i class="nav-icon <?php echo e($level0->icon); ?>"></i>
                                        <?php echo __($level0->title); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                <?php endif; ?>

                
                <!-- Setting -->
                <li class="nav-header">Setting</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.themeOption')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        Theme Option
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.menu')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.changePassword')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                        Tài khoản
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.logout')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>