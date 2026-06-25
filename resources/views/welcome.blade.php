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
        init() {
            this.startAuto();
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
             :style="'background-image: url(' + slide + ')'"
             :class="current === index ? 'opacity-60' : 'opacity-0'">
        </div>
    </template>

    <!-- Dark gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-tr from-zinc-950/80 via-zinc-900/40 to-transparent pointer-events-none"></div>

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

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-40 pb-32 md:pt-52 md:pb-48 flex flex-col justify-center min-h-[70vh]">
        <span class="text-accent-orange font-bold text-sm tracking-widest uppercase mb-4 block">Regional Centre of Expertise - East Java</span>
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
            RCE <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-green-500">EAST JAVA</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-10 leading-relaxed">
            Menghubungkan pendidikan, riset, dan inisiatif lokal untuk mempercepat aksi pencapaian Sustainable Development Goals (SDGs) di seluruh wilayah Jawa Timur.
        </p>
        
        <div class="flex flex-wrap gap-4 mb-16">
            <a href="{{ route('projects.index') }}" class="bg-accent-orange hover-bg-accent-orange text-white px-8 py-4 rounded-full font-bold shadow-lg transition duration-200">
                Jelajahi Proyek
            </a>
            <a href="{{ route('staff.index') }}" class="bg-zinc-800/80 hover:bg-zinc-700 text-white border border-zinc-700 px-8 py-4 rounded-full font-bold backdrop-blur transition duration-200">
                Hubungi Kami
            </a>
        </div>
        
        <!-- Stats Counter -->
        <div class="grid grid-cols-3 gap-6 max-w-xl border-t border-zinc-800/80 pt-10">
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

<!-- Section 01: Visi & Misi -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-stretch">
            <div class="bg-gradient-to-br from-emerald-950 to-emerald-900 text-white p-10 rounded-3xl flex flex-col justify-between shadow-xl">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-2 block">Visi Utama</span>
                    <h2 class="text-3xl font-bold leading-snug mb-6">Pusat keunggulan regional terkemuka dalam pembangunan berkelanjutan Jawa Timur.</h2>
                </div>
                <div class="border-t border-emerald-800/60 pt-6">
                    <span class="text-sm text-emerald-400/80">RCE East Java Network</span>
                </div>
            </div>
            
            <div class="bg-amber-600 text-white p-10 rounded-3xl flex flex-col justify-between shadow-xl">
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

            <div class="bg-zinc-50 border border-zinc-100 p-10 rounded-3xl flex flex-col justify-between shadow-md">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-primary-green mb-2 block">Misi Kami</span>
                    <ul class="space-y-4 text-sm text-gray-600">
                        <li class="flex gap-3">
                            <span class="bg-emerald-100 text-primary-green w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shrink-0">1</span>
                            <span>Mendorong integrasi prinsip-prinsip SDGs ke dalam kurikulum pendidikan formal maupun informal.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="bg-emerald-100 text-primary-green w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shrink-0">2</span>
                            <span>Memfasilitasi riset kolaboratif antar universitas dan praktisi untuk melahirkan solusi nyata di Jawa Timur.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="bg-emerald-100 text-primary-green w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shrink-0">3</span>
                            <span>Membangun kesadaran dan kapasitas masyarakat lokal terhadap aksi lingkungan hidup.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 02: Mitra & Kolaborator -->
<div class="py-20 bg-zinc-50 border-y border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block">Jaringan Mitra Akademik</span>
        <h2 class="text-3xl font-extrabold text-primary-green mb-12">Mitra & Kolaborator</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 items-center">
            @foreach(['UNESA', 'ITS', 'UNAIR', 'UNIVERSITAS BRAWIJAYA', 'UIN SUNAN AMPEL'] as $mitra)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100/60 font-black text-gray-400 text-sm tracking-widest hover:text-primary-green hover:shadow transition duration-200">
                    {{ $mitra }}
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Section 03: Aktivitas/Proyek Terbaru -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-primary-green mb-2 block">Galeri Aksi</span>
                <h2 class="text-3xl font-extrabold text-primary-green">Aktivitas Terbaru</h2>
            </div>
            <a href="{{ route('projects.index') }}" class="text-sm font-bold text-accent-orange hover:text-amber-700 flex items-center gap-1">
                Lihat Semua Proyek <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($latestProjects as $project)
                <div class="bg-zinc-50 rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between">
                    <div>
                        <!-- Project Image -->
                        <div class="relative h-48 bg-zinc-200 overflow-hidden">
                            @if($project->image)
                                <img src="{{ asset($project->image) }}" class="w-full h-full object-cover transition hover:scale-105 duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-emerald-950/10 text-primary-green">
                                    <i class="bi bi-image text-3xl"></i>
                                </div>
                            @endif
                            <span class="absolute top-4 left-4 bg-primary-green text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-md">
                                {{ $project->category }}
                            </span>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <span class="text-xs text-gray-400 font-semibold block mb-2">{{ $project->date }}</span>
                            <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed mb-4">
                                {{ $project->description }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Footer Info -->
                    <div class="px-6 pb-6 pt-4 border-t border-zinc-100 flex justify-between items-center bg-zinc-50/50">
                        <span class="text-xs text-gray-500 font-medium">Oleh: {{ $project->author }}</span>
                        @if($project->sdgs)
                            <div class="flex gap-1">
                                @foreach(explode(',', $project->sdgs) as $sdg)
                                    <span class="text-[10px] bg-accent-orange/10 text-accent-orange font-bold px-2 py-0.5 rounded">
                                        {{ trim($sdg) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-400">Belum ada proyek terbaru.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Artikel Terbaru -->
@if($latestArticles->isNotEmpty())
<div class="py-24 bg-zinc-50 border-t border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 mb-2 block">Dari Blog Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-zinc-900">Artikel Terbaru</h2>
            </div>
            <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900 flex items-center gap-1 transition">
                Lihat semua
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestArticles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="group flex flex-col bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden hover:shadow-md transition">
                <!-- Thumbnail -->
                <div class="aspect-[16/9] bg-zinc-100 overflow-hidden">
                    @if($article->thumbnail)
                        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-50 to-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 2v6h6"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <!-- Content -->
                <div class="flex flex-col flex-1 p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-semibold bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full">{{ $article->category }}</span>
                        <span class="text-xs text-zinc-400">{{ $article->published_at?->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-zinc-900 text-base leading-snug mb-2 group-hover:text-emerald-700 transition line-clamp-2">
                        {{ $article->title }}
                    </h3>
                    @if($article->excerpt)
                    <p class="text-zinc-500 text-sm leading-relaxed line-clamp-3 flex-1">{{ $article->excerpt }}</p>
                    @endif
                    <div class="mt-4 flex items-center gap-2 text-xs text-zinc-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $article->author }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- CTA Banner -->
<div class="py-24 bg-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-emerald-950 to-primary-green text-white p-12 md:p-16 rounded-[2.5rem] shadow-xl text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-10 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=1200');"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Bergabunglah dalam Gerakan Keberlanjutan</h2>
                <p class="text-gray-300 text-sm md:text-base mb-8 leading-relaxed">
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
