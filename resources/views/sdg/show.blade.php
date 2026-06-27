@extends('layouts.public')

@section('title', 'SDG ' . $sdg['number'] . ' - ' . $sdg['title'])

@section('content')
<!-- Header -->
<div class="bg-gradient-to-br from-emerald-950 to-primary-green text-white pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('sdg.index') }}" class="inline-flex items-center gap-2 text-emerald-400 hover:text-white text-sm font-semibold mb-6 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar SDGs
        </a>
        <div class="flex items-center gap-5">
            <span class="bg-white/15 text-white text-4xl font-extrabold w-20 h-20 rounded-2xl flex items-center justify-center flex-shrink-0 backdrop-blur-sm border border-white/20 shadow-lg">
                {{ $sdg['number'] }}
            </span>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-1 block">SDG {{ $sdg['number'] }}</span>
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight">{{ $sdg['title'] }}</h1>
                <div class="w-12 h-0.5 bg-accent-orange rounded-full mt-4"></div>
            </div>
        </div>
        <p class="text-gray-300 max-w-2xl text-sm md:text-base leading-relaxed mt-6">
            {{ $sdg['description'] }}
        </p>
        <div class="mt-6">
            <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white text-xs font-bold px-4 py-2 rounded-full">
                {{ $sdg['targets'] }} Target Global
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="bg-zinc-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Detail -->
                <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-8">
                    <h2 class="text-xl font-extrabold text-zinc-900 mb-4">Tentang Tujuan Ini</h2>
                    <p class="text-zinc-600 text-sm leading-relaxed">{{ $sdg['detail'] }}</p>
                </div>

                <!-- Key Targets -->
                <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-8">
                    <h2 class="text-xl font-extrabold text-zinc-900 mb-6">Target Utama</h2>
                    <ul class="space-y-4">
                        @foreach($sdg['points'] as $i => $point)
                        <li class="flex gap-4">
                            <span class="bg-primary-green text-white text-xs font-extrabold w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                {{ $i + 1 }}
                            </span>
                            <span class="text-zinc-600 text-sm leading-relaxed">{{ $point }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- RCE Action -->
                <div class="bg-emerald-950 rounded-3xl p-8 text-white">
                    <h2 class="text-xl font-extrabold mb-4">Aksi RCE Jawa Timur</h2>
                    <p class="text-gray-300 text-sm leading-relaxed">{{ $sdg['rce_action'] }}</p>
                    <a href="{{ route('projects.index') }}"
                       class="inline-flex items-center gap-2 mt-6 bg-accent-orange hover-bg-accent-orange text-white text-sm font-bold px-6 py-3 rounded-full transition shadow-md">
                        Lihat Proyek Terkait
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Navigation SDG -->
                <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-6">
                    <h3 class="text-sm font-extrabold text-zinc-900 uppercase tracking-widest mb-4">Navigasi SDG</h3>
                    <div class="space-y-2">
                        @foreach($sdgs as $item)
                        <a href="{{ route('sdg.show', $item['number']) }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition
                               {{ $item['number'] === $sdg['number']
                                   ? 'bg-primary-green text-white font-bold'
                                    : 'text-zinc-600 hover:bg-zinc-50 hover:text-accent-orange' }}">
                            <span class="font-extrabold w-7 text-center flex-shrink-0 text-xs
                                {{ $item['number'] === $sdg['number'] ? 'text-white' : 'text-zinc-400' }}">
                                {{ $item['number'] }}
                            </span>
                            <span class="line-clamp-1">{{ $item['title'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Prev / Next Navigation -->
        <div class="flex justify-between items-center mt-12 pt-8 border-t border-zinc-200">
            @if($prev)
            <a href="{{ route('sdg.show', $prev['number']) }}"
               class="flex items-center gap-3 bg-white rounded-2xl border border-zinc-100 shadow-sm px-6 py-4 hover:shadow-md transition group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-zinc-400 group-hover:text-accent-orange transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                <div>
                    <span class="text-xs text-zinc-400 block">SDG {{ $prev['number'] }}</span>
                    <span class="text-sm font-bold text-zinc-900 group-hover:text-accent-orange transition">{{ $prev['title'] }}</span>
                </div>
            </a>
            @else
            <div></div>
            @endif

            @if($next)
            <a href="{{ route('sdg.show', $next['number']) }}"
               class="flex items-center gap-3 bg-white rounded-2xl border border-zinc-100 shadow-sm px-6 py-4 hover:shadow-md transition group text-right">
                <div>
                    <span class="text-xs text-zinc-400 block">SDG {{ $next['number'] }}</span>
                    <span class="text-sm font-bold text-zinc-900 group-hover:text-accent-orange transition">{{ $next['title'] }}</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-zinc-400 group-hover:text-accent-orange transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
