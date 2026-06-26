<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - RCE East Java</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
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
</head>

<body x-data="{
    slides: {{ $heroPhotos->isNotEmpty() ? $heroPhotos->map(fn($p) => asset($p->image))->values()->toJson() : json_encode(['https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=800']) }},
    current: 0,
    timer: null,
    init() { this.timer = setInterval(() => { this.current = (this.current + 1) % this.slides.length; }, 5000); }
}" class="bg-zinc-50 antialiased text-gray-800">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Pane: Hero slider -->
        <div class="hidden md:flex md:w-1/2 bg-zinc-950 relative overflow-hidden flex-col justify-between p-12 text-white">
            <!-- Slider images -->
            <template x-for="(slide, index) in slides" :key="index">
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                     :style="'background-image: url(' + slide + ')'"
                     :class="current === index ? 'opacity-40' : 'opacity-0'">
                </div>
            </template>
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/60 to-transparent"></div>
            
            <!-- Logo Header -->
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-3">
                    <div class="bg-primary-green text-white p-2 rounded-lg font-bold text-base shadow-md">
                        RCE
                    </div>
                    <span class="font-extrabold text-lg tracking-tight">RCE EAST JAVA</span>
                </a>
            </div>

            <!-- Content Middle/Bottom -->
            <div class="relative z-10 max-w-md">
                <h2 class="text-3xl font-extrabold mb-4 leading-tight">Mewujudkan Masa Depan yang Berkelanjutan di Jawa Timur</h2>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Masuk ke portal Anda untuk mengelola profil, berpartisipasi dalam proyek, dan terhubung dengan jaringan keahlian kami.
                </p>
            </div>

            <!-- Footer Quote -->
            <div class="relative z-10">
                <template x-if="slides.length > 1">
                    <div class="flex gap-1.5 mb-4">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="current = index; clearInterval(timer); timer = setInterval(() => { current = (current + 1) % slides.length; }, 5000);"
                                class="rounded-full transition-all duration-300"
                                :class="current === index ? 'bg-white w-5 h-1.5' : 'bg-white/40 w-1.5 h-1.5'">
                            </button>
                        </template>
                    </div>
                </template>
                <p class="text-xs text-gray-500">&copy; 2026 RCE East Java Network. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Pane: Login Form -->
        <div class="flex-1 flex flex-col justify-center items-center p-8 bg-white md:bg-zinc-50">
            <div class="w-full max-w-md bg-white p-8 md:p-10 rounded-[2rem] md:shadow-md border border-transparent md:border-zinc-100">
                
                <!-- Header Form -->
                <div class="mb-8">
                    <!-- Mobile logo only -->
                    <div class="md:hidden flex justify-center mb-6">
                        <a href="/" class="flex items-center gap-2">
                            <div class="bg-primary-green text-white p-2 rounded-lg font-bold text-base">RCE</div>
                            <span class="font-extrabold text-lg tracking-tight text-primary-green">RCE EAST JAVA</span>
                        </a>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Selamat Datang Kembali</h3>
                    <p class="text-gray-500 text-sm">Silakan masuk menggunakan akun terdaftar Anda.</p>
                </div>

                <!-- Session Status Alert -->
                @if (session('status'))
                    <div class="mb-4 bg-emerald-50 text-emerald-700 text-sm p-4 rounded-xl border border-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm @error('email') border-red-500 focus:ring-red-500 @enderror" placeholder="nama@rce-eastjava.org">
                            <i class="bi bi-envelope-fill absolute left-3.5 top-3.5 text-gray-400"></i>
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-accent-orange hover:underline font-semibold" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm @error('password') border-red-500 focus:ring-red-500 @enderror" placeholder="••••••••">
                            <i class="bi bi-lock-fill absolute left-3.5 top-3.5 text-gray-400"></i>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-zinc-300 text-primary-green focus:ring-primary-green h-4 w-4">
                        <label for="remember_me" class="ms-2 text-xs text-gray-600 font-medium cursor-pointer">Ingat Saya</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-primary-green hover-bg-primary-green text-white py-3.5 rounded-2xl font-bold text-sm shadow-md transition duration-150 ease-in-out mt-2">
                        Masuk
                    </button>
                </form>
                
                <!-- Back Link -->
                <div class="text-center mt-6">
                    <a href="/" class="text-xs text-gray-500 hover:text-primary-green font-semibold">
                        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('click', function(e) {
        const pop = document.createElement('div');
        pop.style.cssText = `
            position: fixed; left: ${e.clientX}px; top: ${e.clientY}px;
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(30, 70, 32, 0.5);
            pointer-events: none; transform: translate(-50%, -50%) scale(0);
            z-index: 9999;
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
            opacity: 0;
        `;
        document.body.appendChild(pop);
        requestAnimationFrame(() => {
            pop.style.transform = 'translate(-50%, -50%) scale(6)';
            pop.style.opacity = '0.7';
        });
        setTimeout(() => {
            pop.style.opacity = '0';
            setTimeout(() => pop.remove(), 300);
        }, 150);
    });
</script>

</html>
