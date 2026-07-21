@extends('layouts.public')

@section('title', $staff->name)

@section('styles')
<style>
    .staff-body { word-break: break-word; overflow-wrap: break-word; overflow: hidden; }
    .staff-body h1 { font-size: 1.875rem; font-weight: 800; margin: 1.5rem 0 0.75rem; color: #111827; line-height: 1.3; }
    .staff-body h2 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 0.75rem; color: #111827; line-height: 1.3; }
    .staff-body h3 { font-size: 1.25rem; font-weight: 700; margin: 1.25rem 0 0.6rem; color: #1f2937; line-height: 1.4; }
    .staff-body p  { margin: 0 0 1rem; line-height: 1.8; color: #374151; }
    .staff-body ul { list-style: disc; padding-left: 1.5rem; margin: 0 0 1rem; }
    .staff-body ol { list-style: decimal; padding-left: 1.5rem; margin: 0 0 1rem; }
    .staff-body li { margin-bottom: 0.35rem; line-height: 1.7; color: #374151; }
    .staff-body strong { font-weight: 700; color: #111827; }
    .staff-body em { font-style: italic; }
    .staff-body a  { color: #1e4620; text-decoration: underline; font-weight: 500; }
    .staff-body a:hover { color: #d97724; }
    .staff-body hr { border: none; border-top: 1px solid #e5e7eb; margin: 2rem 0; }
</style>
@endsection

@section('content')

<!-- Header -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-32 pb-20">
    <!-- Background photo with opacity -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=1920'); opacity: 0.6;"></div>
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/60 via-zinc-900/30 to-zinc-950/80 pointer-events-none"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-zinc-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Home</a>
            <span>/</span>
            <a href="{{ route('staff.index') }}" class="hover:text-emerald-400 transition">Our People</a>
            <span>/</span>
            <span class="text-zinc-300">{{ $staff->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row gap-8 items-start">
            <!-- Photo -->
            <div class="flex-shrink-0">
                @if($staff->image)
                    <img src="{{ asset($staff->image) }}" alt="{{ $staff->name }}"
                         class="w-36 h-36 md:w-44 md:h-44 rounded-2xl object-cover ring-4 ring-emerald-500/30 shadow-2xl">
                @else
                    <div class="w-36 h-36 md:w-44 md:h-44 rounded-2xl bg-emerald-900/40 flex items-center justify-center ring-4 ring-emerald-500/20 shadow-2xl">
                        <i class="bi bi-person text-5xl text-emerald-400"></i>
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="flex-1">
                <span class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3
                    {{ $staff->category === 'Researcher' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-orange-500/20 text-orange-300' }}">
                    {{ $staff->category }}
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">{{ $staff->name }}</h1>
                <p class="text-emerald-400 font-semibold text-lg mb-4">{{ $staff->role }}</p>
                <div class="w-12 h-1 bg-accent-orange rounded-full mb-5"></div>

                <!-- Expertise tags -->
                @if($staff->expertise)
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach(explode(',', $staff->expertise) as $exp)
                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">
                                {{ trim($exp) }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Contact links -->
                <div class="flex flex-wrap gap-3">
                    @if($staff->email)
                        <a href="mailto:{{ $staff->email }}"
                           class="flex items-center gap-2 px-4 py-2 rounded-xl bg-zinc-800 hover:bg-emerald-900/50 text-zinc-300 hover:text-emerald-300 transition text-sm font-medium border border-zinc-700">
                            <i class="bi bi-envelope-fill"></i> {{ $staff->email }}
                        </a>
                    @endif
                    @if($staff->linkedin)
                        <a href="https://{{ $staff->linkedin }}" target="_blank"
                           class="flex items-center gap-2 px-4 py-2 rounded-xl bg-zinc-800 hover:bg-blue-900/50 text-zinc-300 hover:text-blue-300 transition text-sm font-medium border border-zinc-700">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Description / Bio -->
@if($staff->description && strip_tags($staff->description) !== '')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-8 md:p-12">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 mb-3 block">About</span>
        <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Profile & Background</h2>
        <div class="w-10 h-1 bg-accent-orange rounded-full mb-8"></div>
        <div class="staff-body">
            {!! $staff->description !!}
        </div>
    </div>
</div>
@endif

<!-- Back button -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 {{ $staff->description && strip_tags($staff->description) !== '' ? 'pt-0' : 'pt-14' }}">
    <a href="{{ route('staff.index') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-900 transition">
        <i class="bi bi-arrow-left"></i> Back to Our People
    </a>
</div>

@endsection
