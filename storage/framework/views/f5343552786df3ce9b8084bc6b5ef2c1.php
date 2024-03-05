<?php $__env->startSection('seo'); ?>
    <?php
        $title_head = 'Danh sách ảnh';
        $data_seo = [
            'title' => 'Danh sách ảnh | ' . Helpers::get_option_minhnn('seo-title-add'),
        ];
        $seo = WebService::getSEO($data_seo);
    ?>
    <?php echo $__env->make('admin.partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugin/DataTables/datatables.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Slider</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">

                            <div class="clear">
                                <?php echo $__env->make('admin.partials.button_add_delete', ['type' => 'slider', 'route' => route('admin.createSlider')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="fr">
                                    <form method="GET" action="" id="frm-filter-post" class="form-inline">
                                        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Từ khoá" value="<?php echo e(request('search_name')); ?>">
                                        <button type="submit" class="btn btn-primary ml-2">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-bordered list-data v-center" id="table_index">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">
                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" id="selectall" onclick="select_all()">
                                                    <label for="selectall"></label>
                                                </div>
                                            </th>
                                            <th class="text-center" style="width:100px">Ưu tiên</th>
                                            <th class="text-center">Short code</th>
                                            <th class="text-center">Tên</th>
                                            <th class="text-center">Ngày đăng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="icheck-info d-inline">
                                                        <input type="checkbox" id="<?php echo e($item->id); ?>" name="seq_list[]" value="<?php echo e($item->id); ?>">
                                                        <label for="<?php echo e($item->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" id="sort" class="form-control quick_change_value text-center" data-id="<?php echo e($item->id); ?>" data-model="<?php echo e(get_class($item)); ?>" value="<?php echo e($item->sort); ?>" reload-on-change>
                                                </td>
                                                <td class="text-center">
                                                    [slider id="<?php echo e($item->id); ?>" items="<?php echo e($item->children->count()); ?>"]
                                                </td>
                                                <td class="text-center">
                                                    <a class="row-title fw-bold" href="<?php echo e(route('admin.sliderDetail', $item->id)); ?>">
                                                        <?php echo e($item->name); ?>

                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo e($item->updated_at); ?>

                                                    <br>
                                                    <input type="checkbox" id="status" class="quick_change_value" <?php if($item->status == 1): echo 'checked'; endif; ?> value="1" value-off="0" data-id="<?php echo e($item->id); ?>" data-model="<?php echo e(get_class($item)); ?>" data-toggle="toggle" data-on="Công khai" data-off="Bản nháp"
                                                        data-onstyle="success" data-offstyle="light">
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="fr">
                                <?php echo $data->links(); ?>

                            </div>

                        </div> <!-- /.card-body -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('plugin/DataTables/datatables.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/admin/slider-home/index.blade.php ENDPATH**/ ?>