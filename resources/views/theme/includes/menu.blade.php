@php
    $headerMenu = \App\Models\Menus::where('name', 'Menu-main')->first();
@endphp

<nav class="navbar navbar-expand-lg menu-wrap">
    <div class="container">
        {{-- <a class="navbar-brand" href="#">Navbar scroll</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-column">
                @foreach ($headerMenu->items as $item)
                    @php $hasChild = $item->child()->exists(); @endphp
                    @if ($hasChild == 1)
                        <li class="nav-item dropdown {{ $item->class }}">
                            <a class="nav-link menu-link d-none d-lg-block" href="{{ $item->link }}" role="button" aria-expanded="false">
                                {{ $item->label }}
                            </a>
                            <a class="nav-link dropdown-toggle d-block d-lg-none" href="{{ $item->link }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $item->label }}
                            </a>

                            @if ($item->class == 'project')
                                <div class="dropdown-menu">
                                    <div class="container">
                                        <div class="row">
                                            @foreach ($item->child as $item2)
                                                <div class="col-md-6 col-lg-3">
                                                    <a href="https://onehealth.foundation/vi/lang-thien-nguyen/" class="dropdown-item">
                                                        <img src="{{ get_image($item2->image) }}" class="img-fluid" alt="" loading="lazy">
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @else
                                <ul class="dropdown-menu">
                                    @foreach ($item->child as $item2)
                                        <li><a class="dropdown-item" href="{{ $item2->link }}">{{ $item2->label }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @else
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => $loop->iteration == 1]) aria-current="page" href="{{ $item->link }}">{{ $item->label }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- <li class="nav-item dropdown project">
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
                                    <a href="{{ route('index') }}" class="dropdown-item">
                                        <img src="https://onehealth.foundation/wp-content/uploads/2019/10/key-project-4.jpg" class="img-fluid" alt="" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li> --}}
            </ul>
            <form class="d-flex" role="search" method="post" action="{{ route('search') }}">
                <div class="input-group input-group-search">
                    <button class="input-group-text bg-transparent border-0" id="header_search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="header_search">
                </div>
            </form>
        </div>
    </div>
</nav>

@push('scripts')
    {{-- <script>
        $('.dropdown-link').on('click', function() {
            console.log(123);
            window.location.href = $(this).attr('href');
        });
    </script> --}}
@endpush
