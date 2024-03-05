<?php
    $data_type = $data_type ?? '';
    $parent = $parent ?? 0;
?>

<?php if($data_type == ''): ?>
    <?php
        $db = \App\Models\Category::where('status', 1)
            ->where('type', 'post')
            ->where('parent', 0);
        if (isset($id)) {
            $db->whereNot('id', $id);
        }
        $categories = $db->get();
    ?>
    <select class="custom-select mr-2" name="parent">
        <option value="0">== Không có ==</option>
        <?php if($categories->count() > 0): ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e($parent == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                <?php if($category->children('post')->get()): ?>
                    <?php echo $__env->make('admin.post-category.includes.select-category', [
                        'data' => $category->children('product')->get(),
                        'data_type' => 'option',
                        'parent' => $parent,
                        'slit' => '&nbsp;&nbsp;&nbsp;&nbsp;',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>
<?php else: ?>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($item->id); ?>" <?php echo e($parent == $item->id ? 'selected' : ''); ?>><?php echo $slit; ?><?php echo e($item->name); ?></option>
        <?php if($item->children('post')->get()): ?>
            <?php echo $__env->make('admin.post-category.includes.select-category', [
                'data' => $item->children('post')->get(),
                'data_type' => 'option',
                'parent' => $parent,
                'slit' => $slit . '&nbsp;&nbsp;&nbsp;&nbsp;',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/post-category/includes/select-category.blade.php ENDPATH**/ ?>