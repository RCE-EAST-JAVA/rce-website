<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RCE East Java</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Scripts & Styles (Vite Tailwind from Breeze) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f7f9f6;
        }
        .text-primary-green {
            color: #1e4620;
        }
        .bg-primary-green {
            background-color: #1e4620;
        }
        .hover-bg-primary-green:hover {
            background-color: #153216;
        }
        .bg-accent-orange {
            background-color: #d97724;
        }
        .hover-bg-accent-orange:hover {
            background-color: #b75e18;
        }
    </style>
    @yield('styles')
</head>

<body class="antialiased text-gray-800">
    <!-- Navbar -->
    <nav x-data="{ scrolled: window.scrollY > 10 }"
         @scroll.window="scrolled = window.scrollY > 10"
         :class="scrolled
             ? 'bg-white border-b border-gray-100 shadow-sm'
             : 'bg-transparent border-b border-transparent shadow-none'"
         class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- Logo & Name -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('logo-new.png') }}" alt="RCE Logo"
                             class="rounded-lg shadow-md"
                             style="width: 50px; height: 50px; object-fit: contain;">
                        <div>
                            <span :class="scrolled ? 'text-primary-green' : 'text-white'"
                                  class="font-extrabold text-xl tracking-tight transition-colors duration-300">RCE EAST JAVA</span>
                            <span :class="scrolled ? 'text-gray-500' : 'text-white/60'"
                                  class="block text-xs uppercase tracking-widest -mt-1 font-semibold transition-colors duration-300">Sustainability Network</span>
                        </div>
                    </a>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-8 ms-12">
                        <a href="{{ route('home') }}"
                           :class="scrolled
                               ? '{{ Request::is('/') ? 'border-primary-green text-primary-green font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}'
                               : '{{ Request::is('/') ? 'border-white text-white font-bold' : 'border-transparent text-white/80 hover:text-white hover:border-white/50' }}'"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Beranda
                        </a>
                        <a href="{{ route('projects.index') }}"
                           :class="scrolled
                               ? '{{ Request::is('proyek*') ? 'border-primary-green text-primary-green font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}'
                               : '{{ Request::is('proyek*') ? 'border-white text-white font-bold' : 'border-transparent text-white/80 hover:text-white hover:border-white/50' }}'"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Portofolio Proyek
                        </a>
                        
                        <a href="{{ route('articles.index') }}"
                           :class="scrolled
                               ? '{{ Request::is('artikel*') ? 'border-primary-green text-primary-green font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}'
                               : '{{ Request::is('artikel*') ? 'border-white text-white font-bold' : 'border-transparent text-white/80 hover:text-white hover:border-white/50' }}'"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            Artikel
                        </a>

                         <a href="{{ route('staff.index') }}"
                           :class="scrolled
                               ? '{{ Request::is('staf*') ? 'border-primary-green text-primary-green font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}'
                               : '{{ Request::is('staf*') ? 'border-white text-white font-bold' : 'border-transparent text-white/80 hover:text-white hover:border-white/50' }}'"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                             Staf
                        </a>

                        <a href="{{ route('sdg.index') }}"
                           :class="scrolled
                               ? '{{ Request::is('sdg*') ? 'border-primary-green text-primary-green font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}'
                               : '{{ Request::is('sdg*') ? 'border-white text-white font-bold' : 'border-transparent text-white/80 hover:text-white hover:border-white/50' }}'"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                            SDGs
                        </a>

                       
                        
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           :class="scrolled ? 'bg-primary-green text-white' : 'bg-white/15 hover:bg-white/25 text-white border border-white/30 backdrop-blur-sm'"
                           class="px-5 py-2.5 rounded-full text-sm font-semibold shadow-md transition-all duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           :class="scrolled ? 'bg-primary-green text-white' : 'bg-white/15 hover:bg-white/25 text-white border border-white/30 backdrop-blur-sm'"
                           class="px-5 py-2.5 rounded-full text-sm font-semibold shadow-md transition-all duration-300">
                            Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Branding -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('logo-new.png') }}" alt="RCE Logo"
                             class="rounded"
                             style="width: 38px; height: 38px; object-fit: cover;">
                        <span class="font-extrabold text-xl tracking-tight">RCE EAST JAVA</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Regional Centre of Expertise on Education for Sustainable Development East Java (RCE East Java) adalah wadah kolaborasi untuk mendorong pembangunan berkelanjutan melalui pendidikan dan aksi nyata di Jawa Timur.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-6 border-b border-zinc-800 pb-2">Navigasi Cepat</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('projects.index') }}" class="hover:text-white transition">Portofolio Proyek</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition">Artikel</a></li>
                        <li><a href="{{ route('sdg.index') }}" class="hover:text-white transition">Sustainable Development Goals</a></li>
                        <li><a href="{{ route('staff.index') }}" class="hover:text-white transition">Direktori Staf</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="font-bold text-lg mb-6 border-b border-zinc-800 pb-2">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex gap-3">
                            <i class="bi bi-geo-alt-fill text-accent-orange text-lg"></i>
                            <span>Surabaya, Jawa Timur, Indonesia</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="bi bi-envelope-fill text-accent-orange text-lg"></i>
                            <span>info@rce-eastjava.org</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="bi bi-telephone-fill text-accent-orange text-lg"></i>
                            <span>+62 31 1234 5678</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-zinc-800 mt-12 pt-8 text-center text-sm text-gray-500 flex justify-between items-center flex-wrap gap-4">
                <p>&copy; 2026 RCE East Java. Semua Hak Cipta Dilindungi.</p>
                <p>Designed for Sustainable Development Goals (SDGs)</p>
            </div>
        </div>
    </footer>
    @yield('scripts')
    
    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 40,
        });
    </script>

    <!-- Click splash effect -->
    <script>
        document.addEventListener('click', function(e) {
            const colors = ['#1e4620', '#d97724', '#34d399', '#10b981', '#fbbf24'];
            const count = 8;
            for (let i = 0; i < count; i++) {
                const drop = document.createElement('div');
                const angle = (i / count) * 360;
                const dist = 40 + Math.random() * 30;
                const rad = angle * (Math.PI / 180);
                const dx = Math.cos(rad) * dist;
                const dy = Math.sin(rad) * dist;
                const size = 4 + Math.random() * 4;
                drop.style.cssText = `
                    position: fixed; left: ${e.clientX}px; top: ${e.clientY}px;
                    width: ${size}px; height: ${size}px; border-radius: 50%;
                    background: ${colors[i % colors.length]};
                    pointer-events: none; z-index: 9999;
                    transition: transform 0.5s cubic-bezier(.25,.46,.45,.94), opacity 0.5s ease-out;
                    transform: translate(-50%, -50%);
                    opacity: 0;
                `;
                document.body.appendChild(drop);
                requestAnimationFrame(() => {
                    drop.style.transform = `translate(calc(-50% + ${dx}px), calc(-50% + ${dy}px)) scale(0.3)`;
                    drop.style.opacity = '0.8';
                });
                setTimeout(() => {
                    drop.style.opacity = '0';
                    setTimeout(() => drop.remove(), 500);
                }, 200 + i * 30);
            }
        });
    </script>
</body>

</html>
