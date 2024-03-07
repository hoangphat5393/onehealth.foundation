<?php
    $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
?>

<nav class="navbar navbar-expand-lg menu-wrap">
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
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = $item->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a class="dropdown-item" href="<?php echo e($item2->link); ?>"><?php echo e($item2->label); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['nav-link', 'active' => $loop->iteration == 1]); ?>" aria-current="page" href="<?php echo e($item->link); ?>"><?php echo e($item->label); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <li class="nav-item dropdown project">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dự án
                    </a>
                    <div class="dropdown-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/m2030-2/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/257657916.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/trung-tam-thu-gom-rac-thai/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/plastic_bank-1.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <a href="<?php echo e(route('index')); ?>" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/10/key-project-4.jpg" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <form class="d-flex" role="search" method="post" action="<?php echo e(route('search')); ?>">
                <div class="input-group input-group-search">
                    <button class="input-group-text bg-transparent border-0" id="header_search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="header_search">
                </div>
            </form>
        </div>
    </div>
</nav>

<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/menu.blade.php ENDPATH**/ ?>