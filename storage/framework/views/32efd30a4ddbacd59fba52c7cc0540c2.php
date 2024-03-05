
<?php
    if (isset($page_detail)) {
        extract($page_detail->toArray());
        // if ($gallery) {
        //     $gallery = unserialize($gallery);
        // }
    } else {
        $title_head = 'Add new page';
    }

    $title_head = $name ?? '';

    $template = $template ?? '';

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
                    <h1 class="m-0 text-dark"><?php echo e($title_head); ?></h1>
                </div><!-- /.col -->
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
            <form action="<?php echo e(route('admin.postPageDetail')); ?>" method="POST" id="frm-create-page" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($id ?? 0); ?>">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Post Page</h3>
                            </div> <!-- /.card-header -->
                            <div class="card-body">
                                <!-- show error form -->
                                <div class="errorTxt"></div>
                                <div class="form-group">
                                    <label for="post_slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?php echo e($slug ?? ''); ?>">
                                    <?php if($id > 0 && $template == 0): ?>
                                        <p><b style="color: #0000cc;">Demo Link:</b> <u><i><a style="color: #F00;" href="<?php echo $link_url_check; ?>" target="_blank"><?php echo $link_url_check; ?></a></i></u></p>
                                    <?php endif; ?>
                                </div>
                                <ul class="nav nav-tabs hidden" id="tabLang" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">Tiếng việt</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">Tiếng Anh</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">

                                        <div class="form-group">
                                            <label for="post_title">Tiêu đề</label>
                                            <input type="text" class="form-control" id="post_title" name="title" placeholder="Tiêu đề" value="<?php echo e($title ?? ''); ?>">
                                        </div>
                                        <?php
                                            $quote_arr = ['id' => 'description', 'label' => 'Trích dẫn', 'name' => 'description', 'description' => $description ?? ''];
                                            $content_arr = ['id' => 'content', 'label' => 'Nội dung 1', 'name' => 'content', 'content' => $content ?? ''];
                                            $content_arr2 = ['id' => 'content2', 'label' => 'Nội dung 2', 'name' => 'content2', 'content' => $content2 ?? ''];
                                            $content_arr3 = ['id' => 'content3', 'label' => 'Nội dung 3', 'name' => 'content3', 'content' => $content3 ?? ''];
                                            $content_arr4 = ['id' => 'content4', 'label' => 'Nội dung 4', 'name' => 'content4', 'content' => $content4 ?? ''];
                                        ?>
                                        <?php echo $__env->make('admin.partials.quote', $quote_arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr2, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr3, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr4, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                        <div class="form-group">
                                            <label for="title_en">Title</label>
                                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Title" value="<?php echo e($title_en ?? ''); ?>">
                                        </div>
                                        <?php
                                            $quote_arr = ['id' => 'description_en', 'label' => 'Description', 'name' => 'description_en', 'description' => $description_en ?? ''];
                                            $content_arr = ['id' => 'content_en', 'label' => 'Content 1', 'name' => 'content_en', 'content' => $content_en ?? ''];
                                            $content_arr2 = ['id' => 'content2_en', 'label' => 'Content 2', 'name' => 'content2_en', 'content' => $content2_en ?? ''];
                                            $content_arr3 = ['id' => 'content3_en', 'label' => 'Content 3', 'name' => 'content3_en', 'content' => $content3_en ?? ''];
                                            $content_arr4 = ['id' => 'content4_en', 'label' => 'Content 4', 'name' => 'content4_en', 'content' => $content4_en ?? ''];
                                        ?>
                                        <?php echo $__env->make('admin.partials.quote', $quote_arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr2, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr3, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.partials.content', $content_arr4, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="show_promotion" class="title_txt">Template</label>
                                    <select name="template" class="form-control">
                                        <option value="page" <?php echo e($template == 'page' ? 'selected' : ''); ?>>Page</option>
                                        <option value="project" <?php echo e($template == 'project' ? 'selected' : ''); ?>>Dự án</option>
                                    </select>
                                </div>

                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->

                    </div> <!-- /.col-9 -->
                    <div class="col-md-3">
                        <?php echo $__env->make('admin.partials.action_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.partials.image', ['title' => 'Hình ảnh', 'id' => 'img', 'name' => 'image', 'image' => $image ?? ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    </div> <!-- /.col-9 -->
                </div> <!-- /.row -->

                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">SEO</div>
                            <div class="card-body">
                                
                                <?php echo $__env->make('admin.form-seo.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        editorQuote('description');
        editorQuote('description_en');
        editor('content');
        editor('content2');
        editor('content3');
        editor('content4');

        editor('content_en');
        editor('content2_en');
        editor('content3_en');
        editor('content4_en');

        $(function() {
            // $('.slug_slugify').slugify('.title_slugify');
            //xử lý validate
            $("#frm-create-page").validate({
                rules: {
                    post_title: "required",
                },
                messages: {
                    post_title: "Nhập tiêu đề trang",
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/admin/page/single.blade.php ENDPATH**/ ?>