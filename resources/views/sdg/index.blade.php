@extends('layouts.public')

@section('title', 'Sustainable Development Goals')

@section('content')
<!-- Header -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-32 pb-20">
    <!-- Background photo with opacity -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=1920'); opacity: 0.6;"></div>
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/60 via-zinc-900/30 to-zinc-950/80 pointer-events-none"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-3 block">Agenda 2030</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-white">Sustainable Development Goals</h1>
        <div class="w-12 h-1 bg-accent-orange rounded-full mb-5"></div>
        <p class="text-zinc-400 max-w-2xl text-sm md:text-base leading-relaxed">
            The 17 Sustainable Development Goals (SDGs) are the UN's global agenda to end poverty, protect the planet, and ensure prosperity for all people by 2030.
        </p>
        <div class="flex gap-6 mt-8">
            <div class="text-center">
                <span class="block text-3xl font-extrabold text-white">17</span>
                <span class="text-xs text-emerald-400 uppercase tracking-widest font-semibold">Goals</span>
            </div>
            <div class="w-px bg-zinc-700"></div>
            <div class="text-center">
                <span class="block text-3xl font-extrabold text-white">169</span>
                <span class="text-xs text-emerald-400 uppercase tracking-widest font-semibold">Targets</span>
            </div>
            <div class="w-px bg-zinc-700"></div>
            <div class="text-center">
                <span class="block text-3xl font-extrabold text-white">2030</span>
                <span class="text-xs text-emerald-400 uppercase tracking-widest font-semibold">Deadline</span>
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
                    <h3 class="font-bold text-zinc-900 text-base leading-snug mb-3 group-hover:text-accent-orange transition-colors">
                        {{ $sdg['title'] }}
                    </h3>
                    <p class="text-zinc-500 text-sm leading-relaxed mb-4">{{ $sdg['description'] }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-zinc-100">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-orange-50 text-accent-orange">
                            {{ $sdg['targets'] }} Target
                        </span>
                        <span class="text-xs font-semibold text-zinc-400 group-hover:text-accent-orange transition">
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
        <h2 class="text-2xl md:text-3xl font-extrabold text-zinc-900 mb-4">Achieve the SDGs Together in East Java</h2>
        <p class="text-zinc-500 text-sm leading-relaxed mb-8">
            Join the RCE East Java network and become part of a real movement toward a more just, inclusive, and sustainable future.
        </p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('projects.index') }}"
               class="bg-primary-green hover-bg-primary-green text-white px-8 py-3.5 rounded-full font-bold shadow-md transition">
                View SDG Projects
            </a>
            <a href="mailto:info@rce-eastjava.org"
               class="bg-zinc-100 hover:bg-zinc-200 text-zinc-800 px-8 py-3.5 rounded-full font-bold transition">
                Contact Us
            </a>
        </div>
    </div>
</div>
@endsection
