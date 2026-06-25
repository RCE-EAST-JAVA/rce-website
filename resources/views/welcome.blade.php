@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="relative bg-zinc-950 text-white overflow-hidden">
    <!-- Background overlay with a dark premium gradient -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=1200');"></div>
    <div class="absolute inset-0 bg-gradient-to-tr from-zinc-950 via-zinc-900/90 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 md:py-48 flex flex-col justify-center min-h-[70vh]">
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

<!-- CTA Banner -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
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
@endsection
