@extends('layouts.public')

@section('title', $project->title)

@section('content')
<!-- Hero / Header -->
<div class="bg-gradient-to-br from-emerald-950 to-primary-green text-white pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-emerald-400 mb-6 font-semibold uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="opacity-50">/</span>
            <a href="{{ route('projects.index') }}" class="hover:text-white transition">Portofolio Proyek</a>
            <span class="opacity-50">/</span>
            <span class="text-white/60 normal-case font-normal tracking-normal">{{ Str::limit($project->title, 40) }}</span>
        </nav>

        <div class="flex flex-wrap gap-3 mb-5">
            <span class="bg-white/15 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full">
                {{ $project->category }}
            </span>
            <span class="text-xs font-bold px-3 py-1 rounded-full
                {{ $project->status === 'Aktif' ? 'bg-emerald-400/20 text-emerald-300' : 'bg-zinc-400/20 text-zinc-300' }}">
                {{ $project->status }}
            </span>
        </div>

        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6 max-w-4xl">
            {{ $project->title }}
        </h1>

        <div class="flex flex-wrap items-center gap-6 text-sm text-white/60">
            <span class="flex items-center gap-2">
                <i class="bi bi-person-fill text-emerald-400"></i>
                {{ $project->author }}
            </span>
            <span class="flex items-center gap-2">
                <i class="bi bi-calendar3 text-emerald-400"></i>
                {{ $project->date }}
            </span>
            @if($project->sdgs)
                <span class="flex items-center gap-2 flex-wrap">
                    <i class="bi bi-bullseye text-emerald-400"></i>
                    @foreach(explode(',', $project->sdgs) as $sdg)
                        <span class="bg-accent-orange/20 text-orange-300 text-xs font-bold px-2 py-0.5 rounded">
                            {{ trim($sdg) }}
                        </span>
                    @endforeach
                </span>
            @endif
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- Left: Description -->
        <div class="lg:col-span-2">
            <!-- Image Slider -->
            @php
                $allImages = collect();
                if ($project->image) $allImages->push($project->image);
                $allImages = $allImages->merge($project->images->pluck('image'));
            @endphp

            @if($allImages->isNotEmpty())
                <div class="mb-8"
                     x-data="{
                         images: {{ $allImages->map(fn($i) => asset($i))->values()->toJson() }},
                         current: 0,
                         timer: null,
                         init() { this.timer = setInterval(() => { this.next(); }, 4000); },
                         next() { this.current = (this.current + 1) % this.images.length; },
                         prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; },
                         goTo(i) { this.current = i; }
                     }">
                    <div class="relative rounded-3xl overflow-hidden shadow-lg border border-zinc-100 bg-zinc-100" style="height: 460px;">
                        <template x-for="(img, index) in images" :key="index">
                            <img :src="img" :alt="'Image ' + (index + 1)"
                                 class="w-full h-full object-cover transition-opacity duration-500"
                                 :class="current === index ? 'opacity-100' : 'opacity-0 absolute inset-0'">
                        </template>

                        <template x-if="images.length > 1">
                            <div>
                                <button @click="prev(); clearInterval(timer); timer = setInterval(() => { next(); }, 4000);"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full w-9 h-9 flex items-center justify-center shadow-md transition z-10">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button @click="next(); clearInterval(timer); timer = setInterval(() => { next(); }, 4000);"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full w-9 h-9 flex items-center justify-center shadow-md transition z-10">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </template>

                        <template x-if="images.length > 1">
                            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-10 flex gap-1.5">
                                <template x-for="(img, index) in images" :key="index">
                                    <button @click="goTo(index); clearInterval(timer); timer = setInterval(() => { next(); }, 4000);"
                                        class="rounded-full transition-all duration-300"
                                        :class="current === index ? 'bg-white w-5 h-2' : 'bg-white/50 w-2 h-2'">
                                    </button>
                                </template>
                            </div>
                        </template>

                        <!-- Counter badge -->
                        <template x-if="images.length > 1">
                            <span class="absolute top-3 right-3 bg-black/40 text-white text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm z-10"
                                  x-text="(current + 1) + ' / ' + images.length">
                            </span>
                        </template>
                    </div>
                </div>
            @else
                <div class="rounded-3xl overflow-hidden mb-8 bg-zinc-100 border border-zinc-200 flex items-center justify-center" style="height: 320px;">
                    <i class="bi bi-image text-6xl text-zinc-300"></i>
                </div>
            @endif

            <!-- Description -->
            <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-8 md:p-10">
                <span class="text-xs font-bold uppercase tracking-widest text-primary-green mb-3 block">Deskripsi Proyek</span>
                <div class="prose prose-zinc max-w-none text-gray-700 leading-relaxed text-base whitespace-pre-line break-words">
                    {{ $project->description }}
                </div>
            </div>
        </div>

        <!-- Right: Sidebar Info -->
        <div class="flex flex-col gap-6">

            <!-- Info Card -->
            <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-6">
                <span class="text-xs font-bold uppercase tracking-widest text-primary-green mb-4 block">Informasi Proyek</span>
                <ul class="divide-y divide-zinc-100 text-sm">
                    <li class="py-3 flex justify-between gap-4">
                        <span class="text-gray-500 font-medium">Kategori</span>
                        <span class="font-semibold text-gray-800 text-right">{{ $project->category }}</span>
                    </li>
                    <li class="py-3 flex justify-between gap-4">
                        <span class="text-gray-500 font-medium">Status</span>
                        <span class="font-semibold text-right
                            {{ $project->status === 'Aktif' ? 'text-emerald-600' : 'text-zinc-500' }}">
                            {{ $project->status }}
                        </span>
                    </li>
                    <li class="py-3 flex justify-between gap-4">
                        <span class="text-gray-500 font-medium">Penulis</span>
                        <span class="font-semibold text-gray-800 text-right">{{ $project->author }}</span>
                    </li>
                    <li class="py-3 flex justify-between gap-4">
                        <span class="text-gray-500 font-medium">Tanggal</span>
                        <span class="font-semibold text-gray-800 text-right">{{ $project->date }}</span>
                    </li>
                    @if($project->sdgs)
                    <li class="py-3 flex flex-col gap-2">
                        <span class="text-gray-500 font-medium">SDGs Terkait</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(explode(',', $project->sdgs) as $sdg)
                                <span class="text-xs bg-accent-orange/10 text-accent-orange font-bold px-2.5 py-1 rounded-full">
                                    {{ trim($sdg) }}
                                </span>
                            @endforeach
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Back Button -->
            <a href="{{ route('projects.index') }}"
               class="flex items-center justify-center gap-2 bg-white border border-zinc-200 hover:border-primary-green hover:text-primary-green text-gray-600 font-semibold text-sm py-3.5 px-6 rounded-2xl transition-all duration-200">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Daftar Proyek
            </a>
        </div>
    </div>

    <!-- Related Projects -->
    @if($related->isNotEmpty())
    <div class="mt-20">
        <div class="mb-8">
            <span class="text-xs font-bold uppercase tracking-widest text-primary-green mb-2 block">Kategori Serupa</span>
            <h2 class="text-2xl font-extrabold text-gray-900">Proyek Terkait</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('projects.show', $rel->id) }}"
               class="group bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 flex flex-col">
                <div class="relative h-44 bg-zinc-200 overflow-hidden">
                    @if($rel->display_image)
                        <img src="{{ asset($rel->display_image) }}" alt="{{ $rel->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="bi bi-image text-4xl text-zinc-400"></i>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-primary-green text-white text-[10px] font-bold px-2.5 py-1 rounded-full">
                        {{ $rel->category }}
                    </span>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <span class="text-xs text-gray-400 mb-1">{{ $rel->date }}</span>
                    <h3 class="font-bold text-gray-900 line-clamp-2 mb-2 group-hover:text-primary-green transition-colors">
                        {{ $rel->title }}
                    </h3>
                    <p class="text-sm text-gray-500 line-clamp-2 flex-1">{{ $rel->description }}</p>
                    <span class="mt-4 text-xs font-semibold text-primary-green flex items-center gap-1">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
