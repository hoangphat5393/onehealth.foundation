<?php
    // $category_product = Menu::getByName('Categories-product-home');
?>



<?php $__env->startSection('seo'); ?>
    <?php echo $__env->make($templatePath . '.layouts.seo', $seo ?? [], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main id="main">

        <section class="block1">
            <?php echo $__env->make('theme.includes.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </section>

        <section class="block2">
            <div class="container pt-5 pb-5 d-none d-md-block">
                <div class="row">
                    <div class="col-md-12 mission" style="">
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
                            <a class="btn btn-custom" href="https://onehealth.foundation/vi/chung-toi-la-ai/">Chúng tôi là ai <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-block d-md-none" style="background: #999999;">
                <div class="row">
                    <div class="col-md-12 mission">
                        <h3>OUR MISSION</h3>
                        <p></p>
                        <p>One Health Foundation aims to expand public medical care as well as education opportunity to ﬁnancially disadvantage people in Vietnam. We also develop solutions for environmental issues to the local community. We will empower Vietnamese youths to develop themselves to their
                            full
                            potential.</p>
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

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="achievement mx-lg-auto fit-content">
                            <div class="number">
                                <div class="counter">
                                    2000+
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="desc">
                                    TÌNH NGUYỆN VIÊN <br> THƯỜNG TRỰC
                                </div>
                                <div class="icon">
                                    <img src="<?php echo e(asset('images/achievement_1.png')); ?>" class="" alt="" style="width:60px" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="achievement mx-lg-auto fit-content">
                            <div class="number">
                                <div class="counter">
                                    2000+
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="desc">
                                    NHÀ TỪ <br> THIỆN
                                </div>
                                <div class="icon">
                                    <img src="<?php echo e(asset('images/achievement_2.png')); ?>" class="" alt="" style="width:60px" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="achievement mx-lg-auto fit-content">
                            <div class="number">
                                <div class="counter">
                                    700+
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="desc">
                                    HOẠT ĐỘNG <br> TÌNH NGUYỆN
                                </div>
                                <div class="icon">
                                    <img src="<?php echo e(asset('images/achievement_3.png')); ?>" class="" alt="" style="width:60px" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="achievement mx-lg-auto fit-content">
                            <div class="number">
                                <div class="counter">
                                    5000
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="desc">
                                    HOÀN CẢNH KHÓ KHĂN<br> CẦN ĐƯỢC GIÚP ĐỠ
                                </div>
                                <div class="icon">
                                    <img src="<?php echo e(asset('images/achievement_4.png')); ?>" class="" alt="" style="width:60px" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="achievement mx-lg-auto fit-content">
                            <div class="number">
                                <div class="counter">
                                    80+
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="desc">
                                    HỘI THẢO SỨC KHỎE <br> CỘNG ĐỒNG
                                </div>
                                <div class="icon">
                                    <img src="<?php echo e(asset('images/achievement_5.png')); ?>" class="" alt="" style="width:60px" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="block3">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-4">
                        <h3 class="upper">Dự án của chúng tôi</h3>
                        <p class="mb-3">Quỹ từ thiện One Health Foundation (OHF) <br>thực hiện sứ mệnh của chúng tôi thông qua <br>ba dự án chính về y tế, giáo dục và môi trường.</p>
                        <p>OHF tin rằng với đội ngũ thế hệ trẻ Việt Nam ngày nay, các bạn sẽ hết lòng vì cộng đồng để xây dựng đất nước ngày càng phát triển hơn.</p>
                        <a href="/du-an/" class="btn btn-custom my-3">Xem tất cả các dự án <i class="fa-solid fa-angles-right"></i></a>

                        <form method="get" action="#">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-addon2">
                                <button class="btn btn-search" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="row project mb-4 g-0">
                            <div class="col-lg-6 align-items-stretch project__content order-2">
                                <div class="content p-3 bg-white">
                                    <h4><a href="/lang-thien-nguyen/" class="text-main">Làng thiện nguyện</a></h4>
                                    <p>
                                        Mô hình “Làng Thiện Nguyện” được xây dựng trên 60 tỉnh thành Việt Nam sẽ bao gồm cơ sở y tế (Bệnh viện hoặc Phòng Khám Đa Khoa) và cơ sở giáo dục từ Tiểu học tới THPT đảm bảo chất lượng giảng dạy và chi phí phù hợp với thu nhập của người dân địa phương.
                                    </p>
                                </div>
                                <a href="/quyen-gop/" class="project-link bg-white fit-content float-end text-main fw-bold px-2">
                                    <span class="text-uppercase">Quyên góp ngay</span>&nbsp;
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                            </div>
                            <div class="col-lg-6 order-lg-2">
                                <div class="item-product">
                                    <a href="#" title="">
                                        <div class="product-img">
                                            <img class="w-100" src="https://onehealth.foundation/wp-content/themes/thewish/img/demo/lang_thien_nguyen.png" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row project mb-4 g-0">
                            <div class="col-lg-6 align-items-stretch project__content order-2">
                                <div class="content p-3 bg-white">
                                    <h4>
                                        <a href="/lang-thien-nguyen/" class="text-main">Làng thiện nguyện</a>
                                    </h4>
                                    <p>
                                        Mô hình “Làng Thiện Nguyện” được xây dựng trên 60 tỉnh thành Việt Nam sẽ bao gồm cơ sở y tế (Bệnh viện hoặc Phòng Khám Đa Khoa) và cơ sở giáo dục từ Tiểu học tới THPT đảm bảo chất lượng giảng dạy và chi phí phù hợp với thu nhập của người dân địa phương.
                                    </p>
                                </div>
                                <a href="/quyen-gop/" class="project-link bg-white fit-content float-end text-main fw-bold px-2">
                                    <span class="text-uppercase">Quyên góp ngay</span>&nbsp;
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                            </div>
                            <div class="col-lg-6 order-lg-2">
                                <div class="item-product">
                                    <a href="#" title="">
                                        <div class="product-img">
                                            <img class="w-100" src="https://onehealth.foundation/wp-content/themes/thewish/img/demo/img_key_project_2_832x400.jpg" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row project mb-4 g-0">
                            <div class="col-lg-6 align-items-stretch project__content order-2">
                                <div class="content p-3 bg-white">
                                    <h4>
                                        <a href="/m2030-2/" class="text-main">M2030</a>
                                    </h4>
                                    <p>Nhằm nâng cao nhận thức và giảm tỷ lệ tử vong của người dân Việt Nam nói riêng và Châu Á nói chung về căn bệnh sốt rét, dự án M2030 được thực hiện với mục tiêu rằng năm 2030 sẽ là năm không còn bệnh sốt rét tồn tại trên thế giới.</p>
                                </div>
                                <a href="/quyen-gop/" class="project-link bg-white fit-content float-end text-main fw-bold px-2">
                                    <span class="text-uppercase">Quyên góp ngay</span>&nbsp;
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                            </div>

                            <div class="col-lg-6 order-lg-2">
                                <div class="item-product">
                                    <a href="#" title="">
                                        <div class="product-img">
                                            <img class="w-100" src="https://onehealth.foundation/wp-content/themes/thewish/img/demo/img_key_project_3_832x400.jpg" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="block4">
            <div class="container mt-5 pt-5">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold fs-4">HOẠT ĐỘNG</p>
                            <a href="" class="btn btn-custom"> Xem tất cả</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="item-product mb-2">
                            <a href="#" title="">
                                <div class="product-img">
                                    <img src="https://onehealth.foundation/wp-content/uploads/2022/06/DSCF4074-2-scaled.jpg" class="" alt="Bộ sách luyện thi IELTS cho người mới bắt đầu">
                                </div>
                            </a>
                        </div>
                        <h5 class="title desc-truncate">
                            <a href="">CHƯƠNG TRÌNH THỂ THAO GÂY QUỸ</a>
                        </h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="item-product mb-2">
                            <a href="#" title="">
                                <div class="product-img">
                                    <img src="https://onehealth.foundation/wp-content/uploads/2020/05/IMG_5962.png" class="" alt="Bộ sách luyện thi IELTS cho người mới bắt đầu">
                                </div>
                            </a>
                        </div>
                        <h5 class="title desc-truncate">
                            <a href="https://onehealth.foundation/news/one-health-foundation-participates-in-the-celebration-for-the-people-affected-by-covid-19-and-soil-salinity/">
                                One Health Foundation participates in the celebration for the people affected by covid-19 and
                                soil salinity
                            </a>
                        </h5>
                    </div>

                    <div class="col-lg-4">
                        <div class="item-product mb-2">
                            <a href="#" title="">
                                <div class="product-img">
                                    <img src="https://onehealth.foundation/wp-content/uploads/2021/01/kham_benh_tu_thien_phu_yen.jpg" class="" alt="Bộ sách luyện thi IELTS cho người mới bắt đầu">
                                </div>
                            </a>
                        </div>
                        <h5 class="title desc-truncate">
                            <a href="https://onehealth.foundation/news/one-health-foundation-issues-gifts-health-examination-and-distribution-of-medications-supporting-peoples-damages-after-story-in-phu-yen-province/">
                                ONE HEALTH FOUNDATION ISSUES GIFTS, HEALTH EXAMINATION AND DISTRIBUTION OF
                                MEDICATIONS SUPPORTING PEOPLE’S DAMAGES AFTER STORY IN PHU YEN PROVINCE
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="block5">
            <div class="container">
                <p class="fw-bold fs-4 mb-4">ĐỐI TÁC CHÍNH</p>
                <?php echo $__env->make('theme.includes.partner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </section>

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

<?php echo $__env->make($templatePath . '.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\onehealth.foundation\resources\views/theme/home.blade.php ENDPATH**/ ?>