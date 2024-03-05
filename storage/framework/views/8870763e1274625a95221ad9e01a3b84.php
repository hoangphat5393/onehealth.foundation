
<?php
    if (isset($edit_data)) {
        extract($edit_data->toArray());
        if ($gallery) {
            $gallery = unserialize($gallery);
        }
    } else {
        $title_head = 'Thêm bài viết mới';
    }

    $title_head = $name ?? '';

    $id = $id ?? 0;

    $date_update = $updated_at ?? date('Y-m-d H:i:s');
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
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo e($title_head); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="<?php echo e(route('admin.postPost')); ?>" method="POST" id="frm-create-post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($id ?? 0); ?>">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo e($title_head); ?></h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="errorTxt"></div>
                                
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control slug_slugify" id="slug" name="slug" placeholder="Slug" value="<?php echo e($slug ?? ''); ?>">
                                            <?php if($id > 0): ?>
                                                <p><b style="color: #0000cc;">Link:</b>
                                                    <u><i><a style="color: #F00;" href="<?php echo e(route('news.detail', [$slug, $id])); ?>" target="_blank"><?php echo e(route('news.detail', [$slug, $id])); ?></a></i></u>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tiêu đề</label>
                                            <input type="text" class="form-control title_slugify" id="name" name="name" placeholder="Tiêu đề" value="<?php echo e($name ?? ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Trích dẫn</label>
                                            <textarea id="description" name="description"><?php echo $description ?? ''; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Nội dung</label>
                                            <textarea id="content" name="content"><?php echo $content ?? ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="name_en">Title</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Title" value="<?php echo e($name_en ?? ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Description</label>
                                            <textarea id="description_en" name="description_en"><?php echo $description_en ?? ''; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_en">Content</label>
                                            <textarea id="content_en" name="content_en"><?php echo $content_en ?? ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h5>Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="sort" class="col-form-label text-lg-right">Ưu tiên</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="<?php echo e($sort ?? 0); ?>">
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <div class="col-md-3">
                        <?php echo $__env->make('admin.partials.action_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        
                        <div class="card widget-category">
                            <div class="card-header">
                                <h4>Chuyên mục</h4>
                            </div>
                            <div class="card-body max-vh-75">
                                <div class="inside clear">
                                    <?php
                                        $array_checked = isset($edit_data) ? $edit_data->categories->pluck('id')->toArray() : [];
                                        $category_type = 'post';
                                    ?>
                                    <?php echo $__env->make('admin.partials.category-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                        

                        <?php echo $__env->make('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    </div>
                </div> <!-- /.row -->

                
                <div class="row">
                    <div class="col-12 col-md-9">
                        <?php echo $__env->make('admin.form-seo.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');

            editorQuote('description');
            editorQuote('description_en');
            editor('content');
            editor('content_en');

            $('#thumbnail_file').change(function(evt) {
                $("#thumbnail_file_link").val($(this).val());
                $("#thumbnail_file_link").attr("value", $(this).val());
            });

            //xử lý validate
            $("#frm-create-post").validate({
                rules: {
                    name: "required",
                    'category[]': {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    name: "Nhập tiêu đề tin",
                    'category[]': "Chọn thể loại tin",
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/admin/post/single.blade.php ENDPATH**/ ?>