@extends('layouts.public')

@section('title', 'Sustainable Development Goals')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-br from-emerald-950 to-primary-green text-white pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-2 block">Agenda 2030</span>
        <h1 class="text-4xl font-extrabold mb-4">Sustainable Development Goals</h1>
        <p class="text-gray-300 max-w-2xl text-sm md:text-base leading-relaxed">
            17 Tujuan Pembangunan Berkelanjutan (SDGs) adalah agenda global PBB untuk mengakhiri kemiskinan, melindungi planet, dan memastikan kesejahteraan semua orang pada tahun 2030.
        </p>
        <div class="flex gap-6 mt-8">
            <div class="text-center">
                <span class="block text-3xl font-extrabold text-white">17</span>
                <span class="text-xs text-emerald-300 uppercase tracking-widest font-semibold">Tujuan</span>
            </div>
            <div class="w-px bg-emerald-800"></div>
            <div class="text-center">
                <span class="block text-3xl font-extrabold text-white">169</span>
                <span class="text-xs text-emerald-300 uppercase tracking-widest font-semibold">Target</span>
            </div>
            <div class="w-px bg-emerald-800"></div>
            <div class="text-center">
                <span class="block text-3xl font-extrabold text-white">2030</span>
                <span class="text-xs text-emerald-300 uppercase tracking-widest font-semibold">Tenggat</span>
            </div>
        </div>
    </div>
</div>

<!-- SDG Grid -->
<div class="bg-zinc-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($sdgs as $sdg)
            <a href="{{ route('sdg.show', $sdg['number']) }}"
               class="bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition duration-200 group">
                <div class="h-1.5 w-full bg-primary-green"></div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-primary-green text-white text-sm font-extrabold w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            {{ $sdg['number'] }}
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-zinc-400">SDG {{ $sdg['number'] }}</span>
                    </div>
                    <h3 class="font-bold text-zinc-900 text-base leading-snug mb-3 group-hover:text-primary-green transition-colors">
                        {{ $sdg['title'] }}
                    </h3>
                    <p class="text-zinc-500 text-sm leading-relaxed mb-4">{{ $sdg['description'] }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-zinc-100">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-primary-green">
                            {{ $sdg['targets'] }} Target
                        </span>
                        <span class="text-xs font-semibold text-zinc-400 group-hover:text-primary-green transition">
                            Selengkapnya →
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- CTA -->
<div class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-extrabold text-zinc-900 mb-4">Bersama Wujudkan SDGs di Jawa Timur</h2>
        <p class="text-zinc-500 text-sm leading-relaxed mb-8">
            Bergabunglah dengan jaringan RCE Jawa Timur dan jadilah bagian dari gerakan nyata menuju masa depan yang lebih adil, inklusif, dan berkelanjutan.
        </p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('projects.index') }}"
               class="bg-primary-green hover-bg-primary-green text-white px-8 py-3.5 rounded-full font-bold shadow-md transition">
                Lihat Proyek SDGs
            </a>
            <a href="mailto:info@rce-eastjava.org"
               class="bg-zinc-100 hover:bg-zinc-200 text-zinc-800 px-8 py-3.5 rounded-full font-bold transition">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
