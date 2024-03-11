<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="slider-item slider-<?php echo e($slider->id); ?> row mb-2 pb-2 border-bottom align-items-center">
        <input type="hidden" name="slider[]" value="<?php echo e($slider->id); ?>">
        <div class="col-lg-3 ">
            <i class="fa fa-sort"></i>&emsp;&emsp;<img src="<?php echo e(get_image($slider->image)); ?>" class="mx-auto" style="height: 85px;">
        </div>
        <div class="col-lg-3">
            
            <?php echo e($slider->name); ?>

        </div>

        <div class="col-lg-3">
            
            <a href="<?php echo e($slider->link); ?>"><?php echo e($slider->link); ?></a>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <button type="button" class="btn btn-sm btn-info edit-slider" data="<?php echo e($slider->id); ?>" data-parent="<?php echo e($slider->slider_id); ?>">Edit</button>
            <button type="button" class="btn btn-sm btn-danger delete-slider ml-2" data="<?php echo e($slider->id); ?>">Delete</button>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/slider-home/includes/slider-items.blade.php ENDPATH**/ ?>