<?php
    $move_to = $move_to ?? '';
?>
<?php if($paginator->hasPages()): ?>
    <ul class="pagination justify-content-center">
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled">
                <span class="page-link">«</span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a href="<?php echo e($paginator->previousPageUrl() . $move_to); ?>" rel="prev" class="page-link">«</a>
            </li>
        <?php endif; ?>
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <li class="page-item disabled">
                    <span class="page-link"><?php echo e($element); ?></span>
                </li>
            <?php endif; ?>
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active">
                            <a href="<?php echo e($url . $move_to); ?>" class="page-link"><?php echo e($page); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a href="<?php echo e($url . $move_to); ?>" class="page-link"><?php echo e($page); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a href="<?php echo e($paginator->nextPageUrl() . $move_to); ?>" rel="next" class="page-link">»</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">»</span>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/pagination/custom.blade.php ENDPATH**/ ?>