@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
@php
    $heroImages = $heroPhotos->isNotEmpty()
        ? $heroPhotos->map(fn($p) => asset($p->image))->values()->toJson()
        : json_encode(['https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=1920']);
@endphp

<div class="relative bg-zinc-950 text-white overflow-hidden min-h-[70vh]"
     x-data="{
        slides: {{ $heroImages }},
        current: 0,
        timer: null,
        scrollY: 0,
        init() {
            this.startAuto();
            window.addEventListener('scroll', () => { this.scrollY = window.scrollY; }, { passive: true });
        },
        startAuto() {
            this.timer = setInterval(() => { this.next(); }, 5000);
        },
        next() {
            this.current = (this.current + 1) % this.slides.length;
        },
        prev() {
            this.current = (this.current - 1 + this.slides.length) % this.slides.length;
        },
        goTo(i) {
            this.current = i;
            clearInterval(this.timer);
            this.startAuto();
        }
     }">

    <!-- Slider background images -->
    <template x-for="(slide, index) in slides" :key="index">
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
             :style="'background-image: url(' + slide + '); transform: translateY(' + (scrollY * 0.3) + 'px)'"
             :class="current === index ? 'opacity-60' : 'opacity-0'">
        </div>
    </template>

    <!-- Dark gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-tr from-zinc-950/80 via-zinc-900/40 to-transparent pointer-events-none"></div>

    <!-- Parallax decorative blobs -->
    <div class="absolute bottom-20 right-20 w-72 h-72 rounded-full bg-emerald-500/5 blur-3xl pointer-events-none"
         :style="'transform: translate(' + (scrollY * 0.15) + 'px, ' + (scrollY * -0.1) + 'px)'">
    </div>
    <div class="absolute top-32 left-10 w-48 h-48 rounded-full bg-emerald-400/5 blur-2xl pointer-events-none"
         :style="'transform: translate(' + (scrollY * -0.1) + 'px, ' + (scrollY * 0.12) + 'px)'">
    </div>

    <!-- Prev / Next arrows -->
    <template x-if="slides.length > 1">
        <div>
            <button @click="prev(); clearInterval(timer); startAuto();"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-zinc-800/60 hover:bg-zinc-700/80 text-white rounded-full w-10 h-10 flex items-center justify-center transition backdrop-blur-sm"
                aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next(); clearInterval(timer); startAuto();"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-zinc-800/60 hover:bg-zinc-700/80 text-white rounded-full w-10 h-10 flex items-center justify-center transition backdrop-blur-sm"
                aria-label="Next">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </template>

    <!-- Dot indicators -->
    <template x-if="slides.length > 1">
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goTo(index)"
                    class="rounded-full transition-all duration-300"
                    :class="current === index ? 'bg-white w-6 h-2' : 'bg-white/40 w-2 h-2'"
                    :aria-label="'Slide ' + (index + 1)">
                </button>
            </template>
        </div>
    </template>

    <!-- Caption -->
    @if($heroPhotos->isNotEmpty())
    <div class="absolute bottom-10 right-6 z-20 hidden md:block">
        <template x-for="(slide, index) in slides" :key="'cap-' + index">
            <p x-show="current === index"
               x-transition:enter="transition ease-out duration-500"
               x-transition:enter-start="opacity-0 translate-y-2"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="text-xs text-white/50 italic text-right max-w-xs">
                {{ '' }}
            </p>
        </template>
        @foreach($heroPhotos as $i => $photo)
            @if($photo->caption)
            <p x-show="current === {{ $i }}"
               x-transition:enter="transition ease-out duration-500"
               x-transition:enter-start="opacity-0 translate-y-2"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="text-xs text-white/50 italic text-right max-w-xs">
                {{ $photo->caption }}
            </p>
            @endif
        @endforeach
    </div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-40 pb-32 md:pt-52 md:pb-48 flex flex-col justify-center min-h-[70vh]"
         :style="'transform: translateY(' + (scrollY * -0.08) + 'px)'">
        <span data-aos="fade-up" class="text-accent-orange font-bold text-sm tracking-widest uppercase mb-4 block">Regional Centre of Expertise - East Java</span>
        <h1 data-aos="fade-up" data-aos-delay="50" class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
            RCE <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-green-500">EAST JAVA</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="100" class="text-lg md:text-xl text-gray-300 max-w-2xl mb-10 leading-relaxed">
            Menghubungkan pendidikan, riset, dan inisiatif lokal untuk mempercepat aksi pencapaian Sustainable Development Goals (SDGs) di seluruh wilayah Jawa Timur.
        </p>
        
        <div data-aos="fade-up" data-aos-delay="150" class="flex flex-wrap gap-4 mb-16">
            <a href="{{ route('projects.index') }}" class="bg-accent-orange hover-bg-accent-orange text-white px-8 py-4 rounded-full font-bold shadow-lg transition duration-200">
                Jelajahi Proyek
            </a>
            <a href="{{ route('staff.index') }}" class="bg-zinc-800/80 hover:bg-zinc-700 text-white border border-zinc-700 px-8 py-4 rounded-full font-bold backdrop-blur transition duration-200">
                Hubungi Kami
            </a>
        </div>
        
        <!-- Stats Counter -->
        <div data-aos="fade-up" data-aos-delay="200" class="grid grid-cols-3 gap-6 max-w-xl border-t border-zinc-800/80 pt-10">
            <div>
                <span class="block text-3xl md:text-4xl font-extrabold text-white">{{ $stats['projects'] }}+</span>
                <span class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1 block">Inisiatif Proyek</span>
            </div>
            <div>
                <span class="block text-3xl md:text-4xl font-extrabold text-white">{{ $stats['years'] }}</span>
                <span class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1 block">Tahun Berkiprah</span>
            </div>
            <div>
                <span class="block text-3xl md:text-4xl font-extrabold text-white">{{ $stats['staff'] }}+</span>
                <span class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1 block">Akademisi & Peneliti</span>
            </div>
        </div>
    </div>
</div>

<!-- Marquee / Ticker -->
<div class="bg-[#d97724] text-white overflow-hidden py-3">
    <div class="marquee-track flex whitespace-nowrap">
        @php
            $words = ['KOMUNITAS', 'SDGS', 'JAWA TIMUR', 'EDUCATION', 'LINGKUNGAN', 'KOLABORASI', 'UNESCO', 'GREEN FUTURE', 'KEBERLANJUTAN'];
            $separator = '<span class="mx-4 text-amber-200">●</span>';
        @endphp
        <div class="marquee-content flex items-center">
            @foreach($words as $word)
                <span class="text-sm font-bold tracking-widest">{!! $separator !!}{{ $word }}</span>
            @endforeach
        </div>
        <div class="marquee-content flex items-center">
            @foreach($words as $word)
                <span class="text-sm font-bold tracking-widest">{!! $separator !!}{{ $word }}</span>
            @endforeach
        </div>
        <div class="marquee-content flex items-center">
            @foreach($words as $word)
                <span class="text-sm font-bold tracking-widest">{!! $separator !!}{{ $word }}</span>
            @endforeach
        </div>
    </div>
</div>

<!-- Section 01: Visi & Misi -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-stretch">
            <div data-aos="fade-up" class="bg-gradient-to-br from-emerald-950 to-emerald-900 text-white p-10 rounded-3xl flex flex-col justify-between shadow-xl">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-2 block">Visi Utama</span>
                    <h2 class="text-3xl font-bold leading-snug mb-6">Pusat keunggulan regional terkemuka dalam pembangunan berkelanjutan Jawa Timur.</h2>
                    <div class="w-12 h-1 bg-accent-orange rounded-full mb-6"></div>
                </div>
                <div class="border-t border-emerald-800/60 pt-6">
                    <span class="text-sm text-emerald-400/80">RCE East Java Network</span>
                </div>
            </div>
            
            <div data-aos="fade-up" data-aos-delay="50" class="bg-amber-600 text-white p-10 rounded-3xl flex flex-col justify-between shadow-xl">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-200 mb-2 block">Tahun Pendirian</span>
                    <h2 class="text-6xl font-black mb-4">2009</h2>
                    <p class="text-amber-100 text-sm leading-relaxed">
                        Didirikan sebagai bagian dari jaringan global United Nations University (UNU) untuk merespon tantangan pembangunan lingkungan dan sosial melalui pendidikan.
                    </p>
                </div>
                <div class="border-t border-amber-500 pt-6">
                    <span class="text-sm text-amber-200">Diakreditasi oleh UNU-IAS</span>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="100" class="bg-zinc-50 border border-zinc-100 p-10 rounded-3xl flex flex-col justify-between shadow-md">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-primary-green mb-2 block">Misi Kami</span>
                    <ul class="space-y-4 text-sm text-gray-600">
                        <li class="flex gap-3">
                            <span class="bg-orange-100 text-accent-orange w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shrink-0">1</span>
                            <span>Mendorong integrasi prinsip-prinsip SDGs ke dalam kurikulum pendidikan formal maupun informal.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="bg-orange-100 text-accent-orange w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shrink-0">2</span>
                            <span>Memfasilitasi riset kolaboratif antar universitas dan praktisi untuk melahirkan solusi nyata di Jawa Timur.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="bg-orange-100 text-accent-orange w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shrink-0">3</span>
                            <span>Membangun kesadaran dan kapasitas masyarakat lokal terhadap aksi lingkungan hidup.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 02: Mitra & Kolaborator -->
<div class="py-20 bg-gradient-to-br from-zinc-50 to-white border-y border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-widest text-accent-orange mb-3 block">Jaringan Mitra Akademik</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Mitra & Kolaborator</h2>
            <div class="w-16 h-1 bg-accent-orange rounded-full mx-auto mb-5"></div>
            <p class="text-gray-500 max-w-2xl mx-auto mb-14 leading-relaxed">
                Bersama kami mewujudkan riset kolaboratif dan aksi lingkungan berkelanjutan di Jawa Timur.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-5">
            @forelse($partners as $i => $mitra)
                <div data-aos="fade-up" data-aos-delay="{{ $i * 50 }}" class="group relative bg-white p-6 rounded-3xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-zinc-100">
                    <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        @if($mitra->logo)
                            <img src="{{ asset($mitra->logo) }}" alt="{{ $mitra->name }}"
                                class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-green/10 to-emerald-50 flex items-center justify-center group-hover:from-primary-green group-hover:to-emerald-600 transition-all duration-300">
                                <i class="bi bi-building text-2xl text-primary-green group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="font-extrabold text-gray-700 text-sm tracking-wide group-hover:text-primary-green transition-colors duration-200">{{ $mitra->name }}</h3>
                    <div class="mt-3 w-8 h-1 bg-zinc-200 rounded-full mx-auto group-hover:w-12 group-hover:bg-primary-green transition-all duration-300"></div>
                </div>
            @empty
                <div class="col-span-5 text-center py-10 text-gray-400">
                    <i class="bi bi-building text-4xl block mb-3 opacity-50"></i>
                    <p>Belum ada mitra ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Section 03: Aktivitas/Proyek Terbaru -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-aos="fade-up" class="flex justify-between items-end mb-12">
            <div>
            <span class="text-xs font-bold uppercase tracking-widest text-accent-orange mb-2 block">Galeri Aksi</span>
            <h2 class="text-3xl font-extrabold text-primary-green">Aktivitas Terbaru</h2>
            <div class="w-12 h-0.5 bg-accent-orange rounded-full mt-3"></div>
            </div>
            <a href="{{ route('projects.index') }}" class="text-sm font-bold text-accent-orange hover:text-amber-700 flex items-center gap-1">
                Lihat Semua Proyek <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        @if($latestProjects->isNotEmpty())
        @php
            $featured = $latestProjects->get(0);
            $side     = $latestProjects->slice(1, 3);
        @endphp

        {{-- Row 1: featured + 2 kecil di kanan --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-6">
            {{-- Featured --}}
            <a data-aos="fade-up" href="{{ route('projects.show', $featured->id) }}"
               class="group lg:col-span-3 bg-zinc-50 rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition duration-200 flex flex-col">
                <div class="relative h-72 bg-zinc-200 overflow-hidden">
                    @if($featured->display_image)
                        <img src="{{ asset($featured->display_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-950/10 text-primary-green">
                            <i class="bi bi-image text-5xl"></i>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-accent-orange text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-md">
                        {{ $featured->category }}
                    </span>
                </div>
                <div class="p-7 flex flex-col flex-1">
                    <span class="text-xs text-gray-400 font-semibold block mb-2">{{ $featured->date }}</span>
                    <h3 class="font-extrabold text-xl text-gray-900 mb-3 line-clamp-2 group-hover:text-accent-orange transition-colors">{{ $featured->title }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed flex-1">{{ $featured->description }}</p>
                    <div class="flex items-center justify-between mt-5 pt-4 border-t border-zinc-100">
                        <span class="text-xs text-gray-500">Oleh: {{ $featured->author }}</span>
                        @if($featured->sdgs)
                        <div class="flex gap-1">
                            @foreach(explode(',', $featured->sdgs) as $sdg)
                            <span class="text-[10px] bg-accent-orange/10 text-accent-orange font-bold px-2 py-0.5 rounded">{{ trim($sdg) }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </a>

            {{-- 3 kecil di kanan --}}
            <div data-aos="fade-up" data-aos-delay="50" class="lg:col-span-2 flex flex-col gap-4">
                @foreach($side as $i => $project)
                <a href="{{ route('projects.show', $project->id) }}"
                   class="group bg-zinc-50 rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition duration-200 flex gap-4 p-4 flex-1">
                    <div class="w-28 flex-shrink-0 rounded-2xl overflow-hidden bg-zinc-200 self-stretch">
                        @if($project->display_image)
                            <img src="{{ asset($project->display_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-emerald-950/10 text-primary-green">
                                <i class="bi bi-image text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center min-w-0">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-accent-orange mb-1">{{ $project->category }}</span>
                        <h3 class="font-bold text-sm text-gray-900 line-clamp-2 group-hover:text-accent-orange transition-colors leading-snug mb-1">{{ $project->title }}</h3>
                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-1">{{ $project->description }}</p>
                        <span class="text-xs text-gray-400">{{ $project->date }}</span>
                        <span class="text-xs text-gray-400 mt-0.5">Oleh: {{ $project->author }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        @else
            <div class="text-center py-12 text-gray-400">Belum ada proyek terbaru.</div>
        @endif
    </div>
</div>

<!-- Artikel Terbaru -->
@if($latestArticles->isNotEmpty())
<div class="py-24 bg-zinc-50 border-t border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-aos="fade-up" class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-accent-orange mb-2 block">Dari Blog Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-zinc-900">Artikel Terbaru</h2>
                <div class="w-12 h-0.5 bg-accent-orange rounded-full mt-3"></div>
            </div>
            <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-accent-orange hover:text-amber-700 flex items-center gap-1 transition">
                Lihat semua
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Featured article: horizontal full-width --}}
        @php $featuredArticle = $latestArticles->first(); $restArticles = $latestArticles->skip(1); @endphp

        <a data-aos="fade-up" href="{{ route('articles.show', $featuredArticle->slug) }}"
           class="group flex flex-col md:flex-row bg-white rounded-3xl border border-zinc-100 shadow-sm hover:shadow-md overflow-hidden transition mb-6">
            <div class="md:w-2/5 aspect-[16/9] md:aspect-auto bg-zinc-100 overflow-hidden flex-shrink-0">
                @if($featuredArticle->thumbnail)
                    <img src="{{ asset($featuredArticle->thumbnail) }}" alt="{{ $featuredArticle->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full min-h-[200px] flex items-center justify-center bg-gradient-to-br from-emerald-50 to-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex flex-col justify-center p-8 flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs font-semibold bg-orange-50 text-orange-700 px-2.5 py-1 rounded-full">{{ $featuredArticle->category }}</span>
                    <span class="text-xs text-zinc-400">{{ $featuredArticle->published_at?->format('d M Y') }}</span>
                </div>
                <h3 class="font-extrabold text-2xl text-zinc-900 leading-snug mb-3 group-hover:text-accent-orange transition line-clamp-2">
                    {{ $featuredArticle->title }}
                </h3>
                @if($featuredArticle->excerpt)
                <p class="text-zinc-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $featuredArticle->excerpt }}</p>
                @endif
                <div class="flex items-center gap-2 text-xs text-zinc-400 mt-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ $featuredArticle->author }}
                </div>
            </div>
        </a>

        {{-- 2 smaller articles below --}}
        @if($restArticles->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($restArticles as $i => $article)
            <a data-aos="fade-up" data-aos-delay="{{ $i * 50 }}" href="{{ route('articles.show', $article->slug) }}"
               class="group flex gap-5 bg-white rounded-2xl border border-zinc-100 shadow-sm hover:shadow-md p-5 overflow-hidden transition">
                <div class="w-28 h-28 flex-shrink-0 rounded-xl overflow-hidden bg-zinc-100">
                    @if($article->thumbnail)
                        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-50 to-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col justify-center min-w-0">
                    <div class="flex items-center gap-2 mb-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-accent-orange">{{ $article->category }}</span>
                        <span class="text-[10px] text-zinc-400">{{ $article->published_at?->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-sm text-zinc-900 line-clamp-2 group-hover:text-accent-orange transition leading-snug mb-1.5">
                        {{ $article->title }}
                    </h3>
                    @if($article->excerpt)
                    <p class="text-xs text-zinc-500 line-clamp-2 leading-relaxed mb-1.5">{{ $article->excerpt }}</p>
                    @endif
                    <span class="text-xs text-zinc-400">{{ $article->author }}</span>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endif

<!-- CTA Banner -->
<div data-aos="fade-up" class="py-24 bg-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-emerald-950 via-emerald-50 to-emerald-950 p-12 md:p-16 rounded-[2.5rem] shadow-xl text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-5 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=1200');"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-emerald-950">Bergabunglah dalam Gerakan Keberlanjutan</h2>
                <p class="text-zinc-600 text-sm md:text-base mb-8 leading-relaxed">
                    Kami mengundang universitas, peneliti, LSM, instansi pemerintah, dan sukarelawan untuk berkolaborasi dalam berbagai proyek lingkungan dan sosial di Jawa Timur.
                </p>
                <div class="flex justify-center gap-4 flex-wrap">
                    <a href="mailto:info@rce-eastjava.org" class="bg-accent-orange hover-bg-accent-orange text-white px-8 py-3.5 rounded-full font-bold shadow-lg transition">
                        Hubungi Kami via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
