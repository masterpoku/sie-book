<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ $title }} | DiGiDuGo</title>
    <meta name="description" content="" />

    @yield('top')

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template/templateAdmin/assets/img/sa.png') }}" />


    <!-- input word -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('template/templateAdmin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('template/templateAdmin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/templateAdmin/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/templateAdmin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('template/templateAdmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template/templateAdmin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('template/templateAdmin/air-datepicker/dist/css/datepicker.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('template/templateAdmin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('template/templateAdmin/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout Wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('template/templateAdmin/assets/img/sa.png') }}" width="50" alt="Logo">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">CerdasLearn</span>
                    </a>
                    <a href="#" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Menu Aplikasi</span>
                    </li>
                    <li class="menu-item {{ request()->is('data/kelas*') ? 'active' : '' }}">
                        <a href="{{ route('kelas.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-bank"></i>
                            <div>Kelas</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('data/siswa*') ? 'active' : '' }}">
                        <a href="{{ route('siswa.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-contact"></i>
                            <div>Siswa</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('data/nilai*') ? 'active' : '' }}">
                        <a href="{{ route('data.nilai') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-bank"></i>
                            <div>Bank Siswa</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('data/mapel*') ? 'active' : '' }}">
                        <a href="{{ route('mapel.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-book"></i>
                            <div>Mata Pelajaran</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('data/materi*') ? 'active' : '' }}">
                        <a href="{{ route('materi.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-open"></i>
                            <div>Materi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('data/materi*') ? 'active' : '' }}">
                        <a href="{{ route('submateris.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-open"></i>
                            <div>Sub-Materi</div>
                        </a>
                    </li>
             
                    <li class="menu-item {{ request()->is('data/quisioner*') ? 'active' : '' }}">
                        <a href="{{ route('quiz.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-edit-alt"></i>
                            <div>Quisioner</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('data/quisioner*') ? 'active' : '' }}">
                        <a href="{{ route('quiz.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-edit-alt"></i>
                            <div>Validasi</div>
                        </a>
                    </li>
                    
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout Page -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme">
                    <div class="navbar-nav-right d-flex align-items-center">
                        <marquee behavior="scroll" direction="left">
                            Fitur buku dan latihan soal tersedia untuk meningkatkan pengalaman belajar Anda. <a href="https://wa.me/6281554850403" target="_blank">Hubungi Kami</a>.
                        </marquee>
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('template/templateAdmin/assets/img/avatars/Mark.png') }}" alt="User Avatar"
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('template/templateAdmin/assets/img/avatars/Mark.png') }}" class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold">maruji</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content Wrapper -->
                <div class="content-wrapper">
                    @yield('dashboard')
                    <div class="container-xxl flex-grow-1">
                        @yield('content')
                    </div>

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="d-flex justify-content-between">
                            <div>© {{ date('Y') }}, made with by <a href="#" class="footer-link fw-bolder">CloudSide Official</a></div>
                        </div>
                    </footer>
                    <!-- / Footer -->
                </div>
                <!-- / Content Wrapper -->
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('template/templateAdmin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('template/templateAdmin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template/templateAdmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/templateAdmin/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('footer')
</body>

</html>
