@extends('layouts.public')

@section('title', 'Direktori Staf')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-br from-emerald-950 to-primary-green text-white pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-2 block">Jaringan Akademis</span>
        <h1 class="text-4xl font-extrabold mb-4">Direktori Staf</h1>
        <p class="text-gray-300 max-w-2xl text-sm md:text-base leading-relaxed">
            Temukan profil para akademisi, peneliti, dan praktisi di Jawa Timur yang aktif berkolaborasi dan berkontribusi dalam jaringan RCE East Java.
        </p>
    </div>
</div>

<!-- Search & Filter Area -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm">
        <form action="{{ route('staff.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Text -->
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, keahlian, atau peran..." class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>
            </div>
            
            <!-- Affiliation Filter -->
            <div>
                <select name="affiliation" class="w-full py-3 px-4 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                    <option value="">Semua Universitas/Afiliasi</option>
                    <option value="Sepuluh Nopember" {{ request('affiliation') === 'Sepuluh Nopember' ? 'selected' : '' }}>ITS</option>
                    <option value="Surabaya" {{ request('affiliation') === 'Surabaya' ? 'selected' : '' }}>UNESA</option>
                    <option value="Brawijaya" {{ request('affiliation') === 'Brawijaya' ? 'selected' : '' }}>Universitas Brawijaya</option>
                    <option value="Airlangga" {{ request('affiliation') === 'Airlangga' ? 'selected' : '' }}>Universitas Airlangga</option>
                </select>
            </div>
            
            <!-- Button Submit -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary-green hover-bg-primary-green text-white py-3 px-6 rounded-2xl font-semibold text-sm transition">
                    Cari Staf
                </button>
                @if(request()->anyFilled(['search', 'affiliation']))
                    <a href="{{ route('staff.index') }}" class="bg-zinc-100 hover:bg-zinc-200 text-gray-700 py-3 px-4 rounded-2xl font-semibold text-sm flex items-center justify-center transition">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Staff Cards Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-24">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        @forelse($staffs as $staff)
            <div x-data="{ x: 50, y: 50 }"
                 @mousemove="x = ($event.offsetX / $el.offsetWidth) * 100; y = ($event.offsetY / $el.offsetHeight) * 100"
                 @mouseleave="x = 50; y = 50"
                 :style="'background: radial-gradient(circle at ' + x + '% ' + y + '%, rgba(255,255,255,0.12) 0%, transparent 60%);'"
                 class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 aspect-[3/4] cursor-pointer">

                <!-- Fullscreen photo background -->
                @if($staff->image)
                    <img src="{{ asset($staff->image) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-emerald-800 to-teal-600 flex items-center justify-center">
                        <i class="bi bi-person-fill text-white/30 text-8xl"></i>
                    </div>
                @endif

                <!-- Gradient overlay — always visible at bottom -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <!-- Hover overlay — slides up -->
                <div class="absolute inset-0 bg-gradient-to-t from-primary-green/90 via-primary-green/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <!-- Role badge top right -->
                <div class="absolute top-4 right-4 z-20">
                    <span class="text-[10px] font-bold uppercase tracking-wider bg-primary-green text-white px-3 py-1.5 rounded-full shadow-lg">
                        {{ $staff->role }}
                    </span>
                </div>

                <!-- Bottom content -->
                <div class="absolute bottom-0 left-0 right-0 z-20 p-5">

                    <!-- Default state: name + affiliation -->
                    <div class="transform group-hover:-translate-y-2 transition-transform duration-300">
                        <h3 class="font-extrabold text-white text-lg leading-tight drop-shadow-md">{{ $staff->name }}</h3>
                        <p class="text-white/70 text-xs mt-0.5 flex items-center gap-1">
                            <i class="bi bi-building"></i> {{ $staff->affiliation }}
                        </p>
                    </div>

                    <!-- Hover state: expertise + social -->
                    <div class="overflow-hidden max-h-0 group-hover:max-h-40 transition-all duration-500 ease-in-out">
                        @if($staff->expertise)
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                @foreach(array_slice(explode(',', $staff->expertise), 0, 3) as $exp)
                                    <span class="text-[10px] bg-white text-primary-green px-2.5 py-1 rounded-full font-semibold">
                                        {{ trim($exp) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex gap-2 mt-3">
                            @if($staff->email)
                                <a href="mailto:{{ $staff->email }}" onclick="event.stopPropagation()"
                                   class="flex-1 flex items-center justify-center gap-1.5 py-2 rounded-xl bg-white text-primary-green hover:bg-emerald-50 transition-all duration-200 text-xs font-bold shadow-md">
                                    <i class="bi bi-envelope-fill"></i> Email
                                </a>
                            @endif
                            @if($staff->linkedin)
                                <a href="https://{{ $staff->linkedin }}" target="_blank" onclick="event.stopPropagation()"
                                   class="flex-1 flex items-center justify-center gap-1.5 py-2 rounded-xl bg-white text-blue-600 hover:bg-blue-50 transition-all duration-200 text-xs font-bold shadow-md">
                                    <i class="bi bi-linkedin"></i> LinkedIn
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center py-24 bg-white rounded-3xl border border-zinc-100 text-gray-400">
                <i class="bi bi-people text-4xl block mb-4"></i>
                Tidak ditemukan staf yang cocok dengan kriteria pencarian Anda.
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-12">
        {{ $staffs->links() }}
    </div>
</div>
@endsection
