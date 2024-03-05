<?php
    $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
?>

<nav class="navbar navbar-expand-lg menu-wrap">
    <div class="container">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Chúng tôi là ai?
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Ban giám đốc</a></li>
                        <li><a class="dropdown-item" href="#">Tầm nhìn</a></li>
                        <li><a class="dropdown-item" href="#">Sứ mệnh</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    
                    <a class="nav-link" href="<?php echo e(route('news.category', 'hoat-dong')); ?>"> Hoạt động</a>
                    
                </li>
                <li class="nav-item dropdown position-static">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dự án
                    </a>
                    <div class="dropdown-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/Vietnam_7101.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/m2030-2/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/257657916.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <a href="https://onehealth.foundation/vi/trung-tam-thu-gom-rac-thai/" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/11/plastic_bank-1.png" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>

                                <div class="col-md-6 col-lg-3">
                                    <a href="<?php echo e(route('index')); ?>" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/10/key-project-4.jpg" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tài trợ và đối tác
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Đối tác</a></li>
                        <li><a class="dropdown-item" href="#">Tài trợ</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">Chứng thực</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">Liên hệ</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="post" action="<?php echo e(route('search')); ?>">
                <div class="input-group input-group-search">
                    <button class="input-group-text bg-transparent border-0" id="header_search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="header_search">
                </div>
                
            </form>
        </div>
    </div>
</nav>


<?php /**PATH F:\web\onehealth.foundation\resources\views/theme/includes/menu.blade.php ENDPATH**/ ?>