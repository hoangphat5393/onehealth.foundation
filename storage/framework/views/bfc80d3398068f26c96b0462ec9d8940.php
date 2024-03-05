<?php
    $level = $level ?? 0;
    if ($level == 0) {
        $categories = App\Models\Category::where('parent', 0)
            ->where('type', $category_type)
            ->orderByDesc('sort')
            ->get();
    }
?>

<ul id="muti_menu_post" class="muti_menu_right_category">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $checked = '';
            if (in_array($category->id, $array_checked)) {
                $checked = 'checked';
            }
        ?>
        <li class="category_menu_list">
            <label for="checkbox_cmc_<?php echo e($category->id); ?>">
                <input type="checkbox" class="category_item_input" name="category_id[]" value="<?php echo e($category->id); ?>" id="checkbox_cmc_<?php echo e($category->id); ?>" <?php echo e($checked); ?>>
                <span><?php echo e($category->name); ?></span>
            </label>
            <?php if($category->children($category_type)->get()): ?>
                <?php echo $__env->make('admin.partials.category-item', [
                    'categories' => $category->children($category_type)->get(),
                    'level' => $level + 1,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/partials/category-item.blade.php ENDPATH**/ ?>