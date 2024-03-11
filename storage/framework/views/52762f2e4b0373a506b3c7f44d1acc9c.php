<?php
    $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
?>

<nav class="navbar navbar-expand-lg menu-wrap d-none d-lg-block">
    <div class="container">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-column">
                <?php $__currentLoopData = $headerMenu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $hasChild = $item->child()->exists(); ?>
                    <?php if($hasChild == 1): ?>
                        <li class="nav-item dropdown <?php echo e($item->class); ?>">
                            <a class="nav-link menu-link d-none d-lg-block" href="<?php echo e($item->link); ?>" role="button" aria-expanded="false">
                                <?php echo e($item->label); ?>

                            </a>
                            <a class="nav-link dropdown-toggle d-block d-lg-none" href="<?php echo e($item->link); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo e($item->label); ?>

                            </a>
                            <?php if($item->class == 'project'): ?>
                                <div class="dropdown-menu">
                                    <div class="container">
                                        <div class="row">
                                            <?php $__currentLoopData = $item->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 col-lg-3">
                                                    <a href="<?php echo e(route('campaign', [$item2->slug, $item2->id])); ?>" class="dropdown-item">
                                                        <img src="<?php echo e(get_image($item2->image)); ?>" class="img-fluid" alt="<?php echo e($item2->name); ?>">
                                                    </a>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $item->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-item" href="<?php echo e($item2->link); ?>"><?php echo e($item2->label); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['nav-link', 'active' => $loop->iteration == 1]); ?>" aria-current="page" href="<?php echo e($item->link); ?>"><?php echo e($item->label); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <form class="d-flex" role="search" method="get" action="<?php echo e(route('search')); ?>">
                <div class="input-group input-group-search">
                    <button type="submit" class="input-group-text bg-transparent border-0 btn-search" id="header_search">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" class="form-control bg-transparent border-0 input-search" name="keyword" placeholder="<?php echo app('translator')->get('Search'); ?>" aria-label="<?php echo app('translator')->get('Search'); ?>" aria-describedby="header_search">
                </div>
            </form>
        </div>
    </div>
</nav>

<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/menu.blade.php ENDPATH**/ ?>