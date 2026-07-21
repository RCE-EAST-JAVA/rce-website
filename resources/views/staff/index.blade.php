@extends('layouts.public')

@section('title', 'Our People')

@section('content')
<!-- Header Page -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-32 pb-20">
    <!-- Background photo with opacity -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=1920'); opacity: 0.3;"></div>
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/60 to-zinc-950/90 pointer-events-none"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-3 block">Academic Network</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-white">Our People</h1>
        <div class="w-12 h-1 bg-accent-orange rounded-full mb-5"></div>
        <p class="text-zinc-400 max-w-2xl text-sm md:text-base leading-relaxed">
            Discover the profiles of academics, researchers, and practitioners in East Java who actively collaborate and contribute within the RCE East Java network.
        </p>
    </div>
</div>

<!-- Search & Filter Area -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm">
        <form action="{{ route('staff.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="relative md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search name, expertise, or role..."
                       class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>
            </div>

            <!-- Category Filter -->
            <div>
                <select name="category" class="w-full py-3 px-4 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                    <option value="">All Categories</option>
                    <option value="Researcher" {{ request('category') === 'Researcher' ? 'selected' : '' }}>Researcher</option>
                    <option value="Research Assistant" {{ request('category') === 'Research Assistant' ? 'selected' : '' }}>Research Assistant</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary-green hover:bg-emerald-800 text-white py-3 px-6 rounded-2xl font-semibold text-sm flex items-center gap-2 transition">
                    <i class="bi bi-search"></i> Search & Filter
                </button>
                @if(request()->anyFilled(['search', 'category']))
                    <a href="{{ route('staff.index') }}" class="bg-zinc-100 hover:bg-zinc-200 text-gray-700 py-3 px-4 rounded-2xl font-semibold text-sm flex items-center justify-center transition">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- People Cards Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-24">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($staffs as $staff)
            <div onclick="window.location='{{ route('staff.show', $staff->id) }}'"
               class="group relative bg-zinc-900 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 cursor-pointer"
               style="height: 420px;">

                {{-- Background: photo or gradient --}}
                @if($staff->image)
                     <img src="{{ asset($staff->image) }}"
                         class="absolute inset-0 w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/60 to-zinc-900"></div>
                @endif

                {{-- Gradient overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-900/30 to-transparent"></div>



                {{-- Info at bottom --}}
                <div class="absolute bottom-0 left-0 right-0 z-10 p-5">
                    @if($staff->expertise && !$staff->image)
                        <div class="flex flex-wrap gap-1 mb-2">
                            @foreach(array_slice(explode(',', $staff->expertise), 0, 2) as $exp)
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-zinc-800/80 text-zinc-300 border border-zinc-700">{{ trim($exp) }}</span>
                            @endforeach
                        </div>
                    @endif
                        <h3 class="font-extrabold text-white text-lg leading-tight drop-shadow-md mb-1">{{ $staff->name }}</h3>
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full mb-3 inline-block
                            {{ $staff->category === 'Researcher' ? 'bg-emerald-500/80 text-white' : 'bg-orange-500/80 text-white' }}">
                            {{ $staff->category }}
                        </span>
                        <div class="flex gap-2">
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
        @empty
            <div class="col-span-4 text-center py-24 bg-white rounded-3xl border border-zinc-100 text-gray-400">
                <i class="bi bi-people text-4xl block mb-4"></i>
                No people found matching your search criteria.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $staffs->links() }}
    </div>
</div>

@endsection
