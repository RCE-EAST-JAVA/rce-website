<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Portal RCE East Java</title>
    
    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/favicon.svg') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/extensions/bootstrap-icons/font/bootstrap-icons.css') }}">
    
    <style>
        body, .sidebar-wrapper, .menu, h1, h2, h3, h4, h5, h6, .btn, .form-control, .form-select {
            font-family: 'Outfit', sans-serif !important;
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
    </style>
    @yield('styles')
</head>

<body>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
                                <img src="{{ asset('logo-new.png') }}" alt="Logo" class="rounded" style="width: 35px; height: 35px; object-fit: cover;">
                                <div class="d-flex flex-column text-start">
                                    <span class="font-extrabold text-base tracking-tight" style="color: #1e4620; font-family: 'Outfit', sans-serif; font-weight: 800; line-height: 1.1; display: block;">RCE EAST JAVA</span>
                                    <span class="text-muted" style="font-size: 0.6rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; line-height: 1; display: block;">Sustainability Network</span>
                                </div>
                            </a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                role="img" class="iconify iconify--system-uicons" width="20" height="20"
                                viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 1.5v2m0 14v2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m0 14v2m-7-7h2m14 0h2m-12.071-5.657l1.414 1.414m8.486 8.486l1.414 1.414m-12.071 5.657l1.414-1.414m8.486-8.486l1.414-1.414"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                role="img" class="iconify iconify--mdi" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.11 20 12 20 9.88 17.88C7.4 15.4 7.4 11.4 9.88 8.92a7.6 7.6 0 0 1 2.23-1.48c.88-.41 1.84.47 1.5 1.36a6.002 6.002 0 0 0 3.86 7.68m-1.77 1.03a8.006 8.006 0 0 1-5.74-7.46C9.13 11 8.82 12.82 9.5 14.5c.88 2.23 3 3.75 5.5 3.75c.62 0 1.24-.1 1.83-.3z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu Anggota</li>
                        
                        <li class="sidebar-item {{ Request::is('portal/profile') ? 'active' : '' }}">
                            <a href="{{ route('portal.profile') }}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a href="{{ route('webmail.sso') }}" target="_blank" rel="noopener noreferrer" class='sidebar-link'>
                                <i class="bi bi-envelope-fill text-danger"></i>
                                <span>Akses Webmail</span>
                                <i class="bi bi-box-arrow-up-right ms-auto opacity-50" style="font-size: 0.75rem;"></i>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a href="{{ route('bimbingan.sso') }}" target="_blank" rel="noopener noreferrer" class='sidebar-link'>
                                <i class="bi bi-mortarboard-fill text-warning"></i>
                                <span>Sistem Bimbingan</span>
                                <i class="bi bi-box-arrow-up-right ms-auto opacity-50" style="font-size: 0.75rem;"></i>
                            </a>
                        </li>
                        
                        <li class="sidebar-title">Akun</li>
                        
                        <li class="sidebar-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link text-danger'>
                                <i class="bi bi-box-arrow-left text-danger"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div id="main" class='layout-navbar navbar-fixed'>
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="sidebar-toggler d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0"></ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                            <p class="mb-0 text-sm text-gray-500">Anggota RCE</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                @if(auth()->user()->avatar)
                                                    <img src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: bold;">
                                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Halo, {{ explode(' ', auth()->user()->name)[0] }}!</h6>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i> Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title mb-3">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>@yield('page-title')</h3>
                            </div>
                        </div>
                    </div>
                    
                    <section class="section">
                        @if(session('status') === 'profile-updated')
                            <div class="alert alert-success alert-dismissible show fade">
                                Informasi profil Anda berhasil diperbarui.
                                <button type="button" class="btn-close" data-bs-alert="close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('status') === 'password-updated')
                            <div class="alert alert-success alert-dismissible show fade">
                                Password Anda berhasil diperbarui.
                                <button type="button" class="btn-close" data-bs-alert="close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        @yield('content')
                    </section>
                </div>
                
                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2026 &copy; RCE East Java</p>
                        </div>
                        <div class="float-end">
                            <p>Member Portal RCE East Java</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    
    @yield('scripts')
</body>

</html>
