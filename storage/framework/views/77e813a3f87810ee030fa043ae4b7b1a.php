<?php
    $status = $status ?? 1;
?>
<div class="card">
    <div class="card-header">
        <h5>Publish</h5>
    </div> <!-- /.card-header -->
    <div class="card-body">
        <div class="form-group">
            <label for="created">Ngày tạo:</label>
            <div class="input-group">
                <input type="text" id="reservationdate" name="created_at" class="form-control" value="<?php echo e($date_update); ?>">
                <div class="input-group-append input-append-date">
                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mb-2">
            <div class="icheck-primary d-inline mr-3">
                <input type="radio" id="radioDraft" name="status" value="0" <?php echo e($status == 0 ? 'checked' : ''); ?>>
                <label for="radioDraft">Bản nháp</label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="radio" id="radioPublic" name="status" value="1" <?php echo e($status == 1 ? 'checked' : ''); ?>>
                <label for="radioPublic">Công khai</label>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" name="submit" value="save" class="btn btn-info">Lưu</button>
            <button type="submit" name="submit" value="apply" class="btn btn-success">Lưu & sửa</button>
        </div>
    </div> <!-- /.card-body -->
</div><!-- /.card -->

<?php $__env->startPush('scripts'); ?>
    <script>
        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'Y-m-d H:m:s',
            // timepicker: false,
            // showTimezone: true,
        });

        $('.input-append-date').on('click', function() {
            $(this).siblings('input').datetimepicker('show'); //support hide,show and destroy command
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH F:\web\onehealth.foundation\resources\views/admin/partials/action_button.blade.php ENDPATH**/ ?>