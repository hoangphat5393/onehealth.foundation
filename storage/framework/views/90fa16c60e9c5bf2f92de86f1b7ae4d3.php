
<?php
    extract($data);
    if (isset($category)) {
        extract($category->toArray());
    }
    $date_update = $updated_at ?? date('Y-m-d H:i:s');
    $recommended = $recommended ?? 0;
    $hot = $hot ?? 0;
?>
<?php $__env->startSection('seo'); ?>
    <?php
        $data_seo = [
            'title' => $title_head . ' | ' . Helpers::get_option_minhnn('seo-title-add'),
        ];
        $seo = WebService::getSEO($data_seo);
    ?>
    <?php echo $__env->make('admin.partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-end">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo e($title_head); ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="<?php echo e(route('admin.postCategoryPost')); ?>" method="POST" id="frm-create-category" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($id ?? ''); ?>">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e($title_head); ?></h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="<?php echo e($slug ?? ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tiêu đề thể loại tin</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="<?php echo e($name ?? ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Trích dẫn</label>
                                            <textarea id="description" name="description"><?php echo $description ?? ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">Title category</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="<?php echo e($name_en ?? ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Description category</label>
                                            <textarea id="description_en" name="description_en"><?php echo $description_en ?? ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                

                                

                                


                            </div> <!-- /.card-body -->
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="parent" class="col-form-label">Chọn thể loại Cha</label>
                                    <?php echo $__env->make('admin.post-category.includes.select-category', ['parent' => $parent ?? 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <div class="form-group">
                                    <label for="sort" class="col-form-label">Sắp xếp</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="<?php echo e($sort ?? 0); ?>">
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-9 -->

                    <div class="col-md-3">
                        <?php echo $__env->make('admin.partials.action_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    </div> <!-- /.col-md-9 -->
                </div> <!-- /.row -->

                
                <div class="row">
                    <div class="col-12 col-md-9">
                        <?php echo $__env->make('admin.form-seo.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                

            </form>
        </div> <!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {

            editorQuote('description');
            editorQuote('description_en');

            $('#thumbnail_file').change(function(evt) {
                $("#thumbnail_file_link").val($(this).val());
                $("#thumbnail_file_link").attr("value", $(this).val());
            });

            //xử lý validate
            $("#frm-create-category").validate({
                rules: {
                    post_title: "required",
                },
                messages: {
                    post_title: "Nhập tiêu đề thể loại tin",
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                invalidHandler: function(event, validator) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/admin/post-category/single.blade.php ENDPATH**/ ?>