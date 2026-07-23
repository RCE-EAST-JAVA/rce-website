<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin RCE East Java</title>

    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/favicon.svg') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/extensions/bootstrap-icons/font/bootstrap-icons.css') }}">

    <!-- Admin Template -->
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">

    <style>
        * { font-family: 'Outfit', sans-serif !important; }

        /* Sidebar branding */
        .sidebar-brand-name {
            color: #1e4620;
            font-weight: 800;
            font-size: 0.95rem;
            line-height: 1.1;
        }
        .sidebar-brand-sub {
            font-size: 0.58rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            line-height: 1;
            opacity: 0.55;
        }

        /* Active sidebar item indicator */
        .sidebar-item.active > .sidebar-link {
            background: linear-gradient(90deg, #1e4620 0%, #2d6a31 100%) !important;
            color: #fff !important;
            border-radius: 0.5rem;
        }
        .sidebar-item.active > .sidebar-link i {
            color: #fff !important;
        }

        /* Topbar page title */
        .topbar-page-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e4620;
            letter-spacing: -0.01em;
        }

        /* Fix icon vertical alignment */
        .bi, i[class*="bi-"], i[class^="bi-"] {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            line-height: 1 !important;
            vertical-align: middle !important;
        }
        .btn i, .sidebar-link i {
            margin-top: -1px;
        }

        /* Card polish - light */
        .card {
            border-radius: 1rem !important;
            border: 1px solid #f1f5f1 !important;
            box-shadow: 0 1px 8px 0 rgba(30,70,32,.06) !important;
        }
        .card-header {
            background: #fff !important;
            border-bottom: 1px solid #f1f5f1 !important;
            border-radius: 1rem 1rem 0 0 !important;
            padding: 1.1rem 1.4rem !important;
        }
        .card-body { padding: 1.4rem !important; }

        /* Table polish - light */
        .table thead th {
            background: #f8faf8;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #6b7280;
            border-bottom: 1px solid #e9f0ea !important;
        }
        .table tbody tr:hover { background: #f8faf8; }

        /* Btn polish */
        .btn { border-radius: 0.55rem !important; font-weight: 600 !important; }
        .btn-primary {
            background: #1e4620 !important;
            border-color: #1e4620 !important;
        }
        .btn-primary:hover {
            background: #153216 !important;
            border-color: #153216 !important;
        }

        /* Form polish */
        .form-control, .form-select {
            border-radius: 0.55rem !important;
            border-color: #e2e8e2 !important;
            font-size: 0.9rem !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: #1e4620 !important;
            box-shadow: 0 0 0 0.2rem rgba(30,70,32,.12) !important;
        }
        .form-label { font-weight: 600; font-size: 0.875rem; }

        /* Badge polish */
        .badge { border-radius: 0.4rem !important; font-weight: 600 !important; }

        /* Alert polish */
        .alert { border-radius: 0.75rem !important; border: none !important; font-size: 0.9rem; }

        /* Footer */
        footer .footer { font-size: 0.8rem; }

        /* ── Dark mode overrides ── */
        body.dark .sidebar-brand-name {
            color: #6ee27b;
        }
        body.dark .topbar-page-title {
            color: #6ee27b;
        }
        body.dark .card {
            border: 1px solid #2a2f2a !important;
            box-shadow: 0 1px 8px 0 rgba(0,0,0,.25) !important;
        }
        body.dark .card-header {
            background: transparent !important;
            border-bottom: 1px solid #2a2f2a !important;
        }
        body.dark .table thead th {
            background: transparent;
            color: #9ca3af;
            border-bottom: 1px solid #2a2f2a !important;
        }
        body.dark .table tbody tr:hover {
            background: rgba(255,255,255,.04);
        }
        body.dark .form-control,
        body.dark .form-select {
            border-color: #374137 !important;
        }
        body.dark .form-control:focus,
        body.dark .form-select:focus {
            border-color: #4ade80 !important;
            box-shadow: 0 0 0 0.2rem rgba(74,222,128,.12) !important;
        }
        body.dark .dropdown-menu {
            background: #1e2320 !important;
            border: 1px solid #2a2f2a !important;
        }
        body.dark .dropdown-item {
            color: #d1d5db !important;
        }
        body.dark .dropdown-item:hover {
            background: #2a2f2a !important;
            color: #fff !important;
        }
        body.dark .dropdown-divider {
            border-color: #2a2f2a !important;
        }

        /* Laravel Tailwind Pagination Fix in Admin */
        nav[role="navigation"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        nav[role="navigation"] svg {
            width: 1.25rem !important;
            height: 1.25rem !important;
            display: inline-block;
            vertical-align: middle;
        }
        nav[role="navigation"] .hidden {
            display: none !important;
        }
        @media (min-width: 640px) {
            nav[role="navigation"] .sm\:flex-1 {
                flex: 1 1 0% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
            }
            nav[role="navigation"] .sm\:hidden {
                display: none !important;
            }
            nav[role="navigation"] .hidden {
                display: flex !important;
            }
        }
        nav[role="navigation"] .relative.z-0 {
            display: inline-flex;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        nav[role="navigation"] .relative.z-0 a,
        nav[role="navigation"] .relative.z-0 span[aria-current="page"] > span,
        nav[role="navigation"] .relative.z-0 span[disabled] > span {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid #d1d5db;
            background-color: #fff;
            color: #374151;
            text-decoration: none;
            margin-left: -1px;
        }
        nav[role="navigation"] .relative.z-0 a:first-child,
        nav[role="navigation"] .relative.z-0 span:first-child > span {
            border-top-left-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }
        nav[role="navigation"] .relative.z-0 a:last-child,
        nav[role="navigation"] .relative.z-0 span:last-child > span {
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
        nav[role="navigation"] .relative.z-0 a:hover {
            background-color: #f9fafb;
            color: #111827;
        }
        nav[role="navigation"] .relative.z-0 span[aria-current="page"] > span {
            background-color: #1e4620;
            color: #fff;
            border-color: #1e4620;
            z-index: 10;
        }
        nav[role="navigation"] p.text-sm {
            margin-bottom: 0;
            color: #4b5563;
            font-size: 0.875rem;
        }
        nav[role="navigation"] p.text-sm span {
            font-weight: 600;
        }
    </style>

    @yield('styles')
</head>

<body>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>

    <div id="app">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-wrapper active">

                <!-- Sidebar Header -->
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                                <img src="{{ asset('logo-new.png') }}" alt="RCE Logo"
                                     class="rounded"
                                     style="width: 34px; height: 34px; object-fit: cover;">
                                <div class="d-flex flex-column text-start">
                                    <span class="sidebar-brand-name">RCE EAST JAVA</span>
                                    <span class="sidebar-brand-sub">Admin Panel</span>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>

                <!-- Sidebar Menu -->
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-title">Navigasi</li>

                        <li class="sidebar-item {{ Request::is('admin') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('webmail.sso') }}" target="_blank" rel="noopener noreferrer" class="sidebar-link">
                                <i class="bi bi-envelope-fill text-danger"></i>
                                <span>Webmail</span>
                                <i class="bi bi-box-arrow-up-right ms-auto font-size-xs opacity-50" style="font-size: 0.75rem;"></i>
                            </a>
                        </li>

                        <li class="sidebar-title">Konten</li>

                        <li class="sidebar-item {{ Request::is('admin/projects*') ? 'active' : '' }}">
                            <a href="{{ route('admin.projects.index') }}" class="sidebar-link">
                                <i class="bi bi-kanban-fill"></i>
                                <span>Manage Programs</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('admin/articles*') ? 'active' : '' }}">
                            <a href="{{ route('admin.articles.index') }}" class="sidebar-link">
                                <i class="bi bi-newspaper"></i>
                                <span>Manage Publications</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('admin/staff*') ? 'active' : '' }}">
                            <a href="{{ route('admin.staff.index') }}" class="sidebar-link">
                                <i class="bi bi-people-fill"></i>
                                <span>Manage Staff</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('admin/partners*') ? 'active' : '' }}">
                            <a href="{{ route('admin.partners.index') }}" class="sidebar-link">
                                <i class="bi bi-building"></i>
                                <span>Mitra & Kolaborator</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Tampilan</li>

                        <li class="sidebar-item {{ Request::is('admin/hero*') ? 'active' : '' }}">
                            <a href="{{ route('admin.hero.index') }}" class="sidebar-link">
                                <i class="bi bi-images"></i>
                                <span>Foto Hero</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="https://bimbingan.rce-eastjava.org/admin/dashboard" target="_blank" rel="noopener noreferrer" class="sidebar-link">
                                <i class="bi bi-mortarboard-fill text-warning"></i>
                                <span>Sistem Bimbingan</span>
                                <i class="bi bi-box-arrow-up-right ms-auto font-size-xs opacity-50" style="font-size: 0.75rem;"></i>
                            </a>
                        </li>

                        <li class="sidebar-title">Pengaturan & Akun</li>

                        <li class="sidebar-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="sidebar-link">
                                <i class="bi bi-shield-lock-fill text-primary"></i>
                                <span>Kelola Pengguna (RBAC)</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">
                                @csrf
                            </form>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="sidebar-link text-danger">
                                <i class="bi bi-box-arrow-left text-danger"></i>
                                <span>Keluar</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main" class="layout-navbar navbar-fixed">

            <!-- Top Navbar -->
            <header class="mb-3">
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">

                        <!-- Mobile sidebar toggle -->
                        <a href="#" class="sidebar-toggler d-block d-xl-none me-3">
                            <i class="bi bi-list fs-4"></i>
                        </a>

                        <!-- Page title (desktop) -->
                        <span class="topbar-page-title d-none d-md-block">
                            @yield('page-title')
                        </span>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">


                            <!-- User Dropdown -->
                            <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="text-decoration-none">
                                    <div class="user-menu d-flex align-items-center gap-2">
                                        <div class="text-end d-none d-md-block">
                                            <div class="fw-semibold" style="font-size: 0.875rem; line-height: 1.2;">
                                                {{ auth()->user()->name }}
                                            </div>
                                            <div class="text-muted" style="font-size: 0.72rem;">Administrator</div>
                                        </div>
                                        <div class="avatar avatar-md">
                                            @if(auth()->user()->avatar)
                                                <img src="{{ asset(auth()->user()->avatar) }}"
                                                     class="rounded-circle"
                                                     style="width: 38px; height: 38px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                                     style="width:38px;height:38px;background:#1e4620;font-size:0.9rem;">
                                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width: 12rem; border-radius: 0.75rem;">
                                    <li>
                                        <div class="px-3 py-2">
                                            <div class="fw-semibold" style="font-size:0.875rem;">{{ auth()->user()->name }}</div>
                                            <div class="text-muted" style="font-size:0.75rem;">{{ auth()->user()->email }}</div>
                                        </div>
                                    </li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <a href="{{ route('home') }}" target="_blank" class="dropdown-item small">
                                            <i class="bi bi-globe me-2 text-primary"></i> Lihat Website
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <a class="dropdown-item small text-danger" href="#"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-left me-2"></i> Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Page Content -->
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title mb-4">
                        <h3 class="mb-0">@yield('page-title')</h3>
                    </div>

                    <section class="section">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible show fade d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>{{ session('success') }}</span>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible show fade d-flex align-items-center gap-2">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ session('error') }}</span>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </section>
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p class="mb-0">2026 &copy; RCE East Java</p>
                        </div>
                        <div class="float-end">
                            <p class="mb-0">Admin Panel v1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

    @yield('scripts')
</body>

</html>
