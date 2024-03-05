<?php $__env->startSection('seo'); ?>
    <?php echo $__env->make($templatePath . '.layouts.seo', $seo ?? [], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php
    // $custom_fields = $page->custom_field ? json_decode($page->custom_field, true) : '';
?>

<?php $__env->startSection('content'); ?>
    <main id="about">

        <section class="block10">

            <div class="mainBanner">
                <div class="container main-menu">
                    <?php echo $__env->make('theme.includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="container-fluid px-0">
                    <div class="row g-0">
                        <div class="col-lg-12 banner-left">
                            <img class="img-fluid object-fit-cover w-100" src="<?php echo e(get_image($page->image)); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="block8">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h1 class="category-title"><?php echo e($page->title); ?></h1>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo htmlspecialchars_decode($page->content); ?>

                    </div>
                </div>

                <div class="row wwa_mission">
                    <div class="col-md-12 pl-3 mt-4 mb-4 text-center">
                        <div class="mission_dot"><span></span></div>
                        <h3>Sứ mệnh</h3>
                        <p></p>
                        <p>OHF thực hiện những dự án nhằm nâng cao các cơ hội được chăm sóc y tế và giáo dục phổ thông tới những người có hoàn cảnh kinh tế khó khăn tại Việt Nam. Đồng thời chúng tôi sẽ tìm ra các giải pháp khắc phục các vấn đề về ô nhiễm môi trường sống cho cộng đồng. Thông qua các dự
                            án chúng tôi tạo điều kiện để thế hệ trẻ Việt Nam phát triển tối đa tiềm năng của họ</p>
                        <p></p>
                        <!-- <button>Read more ></button> -->
                    </div>
                </div>

                <div class="row wwa_vission">
                    <div class="col-md-12 pl-3 mt-4 mb-4 text-center">
                        <h3>Tầm nhìn</h3>
                        <p></p>
                        <p>OHF tập trung xây dựng một hệ thống y tế cộng đồng bền vững trên toàn lãnh thổ Việt Nam để đảm bảo cho tất cả người dân đều được chăm sóc về y tế, giáo dục hiệu quả với chi phí phù hợp và sống trong môi trường lành mạnh.</p>
                        <p></p>
                        <!-- <button>Read more ></button> -->
                    </div>
                </div>
            </div>
        </section>
        

        
        <section class="block7">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 subscribe-block">
                        <?php echo $__env->make('theme.includes.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make($templatePath . '.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/about/index.blade.php ENDPATH**/ ?>