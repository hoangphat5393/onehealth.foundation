<ul class="d-flex fl mb-4">
    <li class="nav-item">
        <a class="btn btn-danger mr-2" onclick="delete_id('<?php echo e($type); ?>')" href="javascript:void(0)"><i class="fas fa-trash"></i> Xóa</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary mr-2" href="<?php echo e($route); ?>"><i class="fas fa-plus"></i> Thêm mới</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" onclick="replicate_id('<?php echo e($type); ?>')" href="javascript:void(0)"><i class="fa-regular fa-copy"></i> Sao chép</a>
    </li>
</ul>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/partials/button_add_delete.blade.php ENDPATH**/ ?>