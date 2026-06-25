@extends('layouts.public')

@section('title', 'Direktori Staf')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-br from-emerald-950 to-primary-green text-white py-16">
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
            <div class="bg-white rounded-3xl p-6 border border-zinc-100 shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between items-center text-center">
                <div class="flex flex-col items-center w-full">
                    <!-- Profile Picture -->
                    <div class="relative w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-primary-green/20">
                        @if($staff->image)
                            <img src="{{ asset($staff->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-zinc-100 text-zinc-400">
                                <i class="bi bi-person-fill text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Meta info -->
                    <span class="text-[10px] text-accent-orange font-bold uppercase tracking-wider block mb-1">
                        {{ $staff->role }}
                    </span>
                    <h3 class="font-extrabold text-base text-gray-900 mb-1 leading-snug">{{ $staff->name }}</h3>
                    <p class="text-xs text-gray-400 font-medium mb-4">{{ $staff->affiliation }}</p>
                    
                    <!-- Expertise tags -->
                    @if($staff->expertise)
                        <div class="flex flex-wrap justify-center gap-1.5 mb-6">
                            @foreach(explode(',', $staff->expertise) as $exp)
                                <span class="text-[10px] bg-zinc-100 text-gray-600 px-2.5 py-1 rounded-full font-medium">
                                    {{ trim($exp) }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- Social Contact Row -->
                <div class="flex gap-4 border-t border-zinc-100 pt-4 w-full justify-center">
                    @if($staff->email)
                        <a href="mailto:{{ $staff->email }}" class="text-gray-400 hover:text-primary-green transition text-lg">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    @endif
                    @if($staff->linkedin)
                        <a href="https://{{ $staff->linkedin }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition text-lg">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    @endif
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
