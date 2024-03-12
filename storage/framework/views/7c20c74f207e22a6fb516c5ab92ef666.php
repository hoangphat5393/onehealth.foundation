<?php
    // $category_product = Menu::getByName('Categories-product-home');
?>



<?php $__env->startSection('seo'); ?>
    <?php echo $__env->make($templatePath . '.layouts.seo', $seo ?? [], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main id="main">

        <section class="block1">
            <?php echo $__env->make('theme.includes.hero_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </section>

        <section class="block2">
            <div class="container pt-5 pb-5 d-none d-md-block">
                <div class="row">
                    <div class="col-md-12 mission">
                        <h3>SỨ MỆNH</h3>
                        <p>
                            OHF thực hiện những dự án nhằm nâng cao các cơ hội được chăm sóc y tế và giáo dục phổ thông tới những người có hoàn cảnh kinh tế khó khăn tại Việt Nam. Đồng thời chúng tôi sẽ tìm ra các giải pháp khắc phục các vấn đề về ô nhiễm môi trường sống cho cộng đồng. Thông qua các dự
                            án
                            chúng tôi tạo điều kiện để thế hệ trẻ Việt Nam phát triển tối đa tiềm năng của họ
                        </p>
                    </div>
                    <div class="col-md-12 vission">
                        <h3 class="text-end">TẦM NHÌN</h3>
                        <p>OHF tập trung xây dựng một hệ thống y tế cộng đồng bền vững trên toàn lãnh thổ Việt Nam để đảm bảo cho tất cả người dân đều được chăm sóc về y tế, giáo dục hiệu quả với chi phí phù hợp và sống trong môi trường lành mạnh.</p>
                        <div class="d-block text-end">
                            <a class="btn btn-custom" href="<?php echo e(route('page', 'about')); ?>">Chúng tôi là ai <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-block d-md-none" style="background: #999999;">
                <div class="row">
                    <div class="col-md-12 mission">
                        <h3>OUR MISSION</h3>
                        <p></p>
                        <p>
                            One Health Foundation aims to expand public medical care as well as education opportunity to ﬁnancially disadvantage people in Vietnam. We also develop solutions for environmental issues to the local community. We will empower Vietnamese youths to develop themselves to their
                            full potential.
                        </p>
                        <p></p>
                    </div>
                    <div class="col-md-12 vission pb-2" style="">
                        <h3 class="text-right">VISION</h3>
                        <p></p>
                        <p>One Health Foundation funds projects in order to build a nation-wide sustainable public healthcare ecosystem in Vietnam where everyone got eﬀective and aﬀordable medical treatment, education and a clean living environment.</p>
                        <p></p>
                        <a href="https://onehealth.foundation/eg/who-we-are/" class="btn btn-custom">Who We Are</a>
                    </div>
                </div>
            </div>
        </section>

        <?php echo $__env->make('theme.includes.counter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <?php
            $project = \App\Models\Campaign::where('status', 1)->limit(3)->get();
        ?>
        <section class="block3">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-4">
                        <h3 class="upper">Dự án của chúng tôi</h3>
                        <p class="mb-3">Quỹ từ thiện One Health Foundation (OHF) <br>thực hiện sứ mệnh của chúng tôi thông qua <br>ba dự án chính về y tế, giáo dục và môi trường.</p>
                        <p>OHF tin rằng với đội ngũ thế hệ trẻ Việt Nam ngày nay, các bạn sẽ hết lòng vì cộng đồng để xây dựng đất nước ngày càng phát triển hơn.</p>
                        <a href="<?php echo e(route('page', 'du-an')); ?>" class="btn btn-custom my-3"><?php echo app('translator')->get('See all projects'); ?> <i class="fa-solid fa-angles-right"></i></a>

                        <form method="get" action="#">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-addon2">
                                <button class="btn btn-search" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <?php if(empty(!$project)): ?>
                        <div class="col-lg-8">
                            <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row project mb-4 g-0">

                                    <div class="col-lg-6 align-items-stretch project__content order-2">
                                        <div class="content p-3 bg-white">
                                            <h4><a href="<?php echo e(route('campaign.detail', [$item->slug, $item->id])); ?>" class="text-main"><?php echo e($item->name); ?></a></h4>
                                            <div>
                                                <?php echo htmlspecialchars_decode($item->description); ?>

                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('page', 'donate')); ?>" class="project-link bg-white fit-content float-end text-main fw-bold px-2">
                                            <span class="text-uppercase"><?php echo app('translator')->get('Donate now'); ?></span>&nbsp;
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 order-lg-2">
                                        <div class="item-product">
                                            <a href="#" title="">
                                                <div class="product-img">
                                                    <img class="w-100" src="<?php echo e(get_image($item->image)); ?>" alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        
        <?php
            $news = \App\Models\Post::where('status', 1)->orderByDesc('sort')->limit(3)->get();
        ?>
        <section class="block4">
            <div class="container mt-5 pt-5">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold fs-4 text-uppercase"><?php echo app('translator')->get('activity'); ?></p>
                            <a href="<?php echo e(route('news')); ?>" class="btn btn-custom"> <?php echo app('translator')->get('View all'); ?></a>
                        </div>
                    </div>
                </div>

                <?php if(empty(!$news)): ?>
                    <div class="row">
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4">
                                <div class="item-product mb-2">
                                    <a href="<?php echo e(route('news.detail', [$item->slug, $item->id])); ?>" title="<?php echo e($item->name); ?>">
                                        <div class="product-img">
                                            <img src="<?php echo e(get_image($item->image)); ?>" class="" alt="<?php echo e($item->name); ?>">
                                        </div>
                                    </a>
                                </div>
                                <h5 class="title desc-truncate">
                                    <a href="<?php echo e(route('news.detail', [$item->slug, $item->id])); ?>"><?php echo e($item->name); ?></a>
                                </h5>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        
        <?php echo $__env->make('theme.includes.partner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="block6">
            <div class="container testimonial">
                <div class="row py-3">
                    <div class="col-lg-8 p-5">
                        <p class="mb-3">“Tôi đã tìm thấy chính mình tại nơi đây. Cảm ơn Quỹ từ thiện sức khỏe là số 1 đã cho tôi cơ hội để tôi có thể cống hiến hết sức mình vì cộng đồng”</p>
                        <span class="d-block text-end">Bà Vương Thu Nguyệt - Giám đốc điều hành</span>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-fluid" src="<?php echo e(asset('images/vtn.png')); ?>">
                    </div>
                </div>
            </div>
        </section>

        
        <?php echo $__env->make('theme.includes.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($templatePath . '.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/home.blade.php ENDPATH**/ ?>