<?php
    if (isset($slider)) {
        extract($slider->toArray());
    }
?>

<form id="form-editSlider" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo e($id ?? 0); ?>">
    <input type="hidden" name="slider_id" value="<?php echo e($parent ?? 0); ?>">
    <div class="form-group">
        <label for="sub_name">Tên phụ</label>
        <input type="text" class="form-control" id="sub_name" name="sub_name" value="<?php echo e($sub_name ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($name ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="link">Đường dẫn</label>
        <input type="text" class="form-control" name="link" value="<?php echo e($link ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="link">Tên đường dẫn</label>
        <input type="text" class="form-control" name="link_name" value="<?php echo e($link_name ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="sort">Thứ tự</label>
        <input id="sort" type="text" name="sort" class="form-control" value="<?php echo e($sort ?? 0); ?>">
    </div>
    <div class="form-group">
        Ảnh
        <div class="inserIMG">
            <input type="hidden" name="image" id="src-img" value="<?php echo e($image ?? ''); ?>">
            <?php if(isset($src) && $src != ''): ?>
                <img src="<?php echo e(get_image($slider->image)); ?>" id="show-img" class="show-img src-img ckfinder-popup" data-show="show-img" data="src-img" width="200" onerror="this.onerror=null;this.src='<?php echo e(asset('images/placeholder.png')); ?>';">
            <?php else: ?>
                <img src="<?php echo e(asset('images/placeholder.png')); ?>" id="show-img" class="src-img ckfinder-popup" data-show="show-img" data="src-img" width="200">
            <?php endif; ?>
            <span class="remove-icon ml-3">
                <i class="fa-solid fa-xmark fa-lg"></i>
            </span>
        </div>
    </div>

    
    <div class="form-group">
        <textarea name="description" id="description" class="form-control"><?php echo $description ?? ''; ?></textarea>
    </div>
</form>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/slider-home/includes/form.blade.php ENDPATH**/ ?>