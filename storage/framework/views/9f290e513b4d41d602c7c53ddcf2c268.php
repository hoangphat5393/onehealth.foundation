<?php if(count($pages) > 0): ?>
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="tr-item item-level-<?php echo e(isset($level) ? $level : 0); ?>">
            <td class="text-center">
                <div class="icheck-info d-inline">
                    <input type="checkbox" id="<?php echo e($item->id); ?>" name="seq_list[]" value="<?php echo e($item->id); ?>">
                    <label for="<?php echo e($item->id); ?>"></label>
                </div>
            </td>

            <td class="text-center">
                <input type="text" id="sort" class="form-control quick_change_value text-center" data-id="<?php echo e($item->id); ?>" data-model="<?php echo e(get_class($item)); ?>" value="<?php echo e($item->sort); ?>" reload-on-change>
            </td>

            <td class="title">
                <a class="row-title " href="<?php echo e(route('admin.pageEdit', [$item->id])); ?>">
                    <div><b style='color: #056FAD;'><?php echo e($item->title); ?></b></div>
                </a>
                <?php if($item->slug): ?>
                    <div>
                        <b style='color:#777;'>URL:</b>
                        <a style='color:#00C600; word-break:break-all;' target='_blank' href="<?php echo e(route('page', ['slug' => $item->slug])); ?>"><?php echo e(route('page', ['slug' => $item->slug])); ?></a>
                    </div>
                <?php endif; ?>
            </td>
            <td class="text-center">
                <img src="<?php echo e(get_image($item->image)); ?>" style="height: 70px">
            </td>
            <td class="text-center">
                <?php echo e($item->updated_at); ?>

                <br>
                <input type="checkbox" id="status" class="quick_change_value" <?php if($item->status == 1): echo 'checked'; endif; ?> value="1" value-off="0" data-id="<?php echo e($item->id); ?>" data-model="<?php echo e(get_class($item)); ?>" data-toggle="toggle" data-on="Công khai" data-off="Bản nháp" data-onstyle="success"
                    data-offstyle="light">
            </td>
        </tr>
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/page/includes/page_item.blade.php ENDPATH**/ ?>