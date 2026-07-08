@extends('layouts.public')

@section('title', 'Our Programs')

@section('content')
<!-- Header Page -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-32 pb-20">
    <!-- Background gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-emerald-950/40 to-zinc-950 pointer-events-none"></div>
    <!-- Decorative blobs -->
    <div class="absolute top-10 right-20 w-80 h-80 rounded-full bg-emerald-500/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-56 h-56 rounded-full bg-emerald-400/5 blur-2xl pointer-events-none"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-3 block">List of Initiatives</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-white">Our Programs</h1>
        <div class="w-12 h-1 bg-accent-orange rounded-full mb-5"></div>
        <p class="text-zinc-400 max-w-2xl text-sm md:text-base leading-relaxed">
            Explore our regional excellence programs in sustainable development across East Java, from waste management, water, to renewable energy.
        </p>
    </div>
</div>

<!-- Search & Filter Area -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm">
        <form action="{{ route('projects.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search Text -->
            <div class="md:col-span-2 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search programs, location, or topic..." class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>
            </div>
            
            <!-- Category Filter -->
            <div>
                <select name="category" class="w-full py-3 px-4 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                    <option value="">All Categories</option>
                    <option value="Research" {{ request('category') === 'Research' ? 'selected' : '' }}>Research</option>
                    <option value="Community Development" {{ request('category') === 'Community Development' ? 'selected' : '' }}>Community Development</option>
                    <option value="Capacity Building" {{ request('category') === 'Capacity Building' ? 'selected' : '' }}>Capacity Building</option>
                </select>
            </div>
            
            <!-- Button Submit -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary-green hover-bg-primary-green text-white py-3 px-6 rounded-2xl font-semibold text-sm transition">
                    Cari & Filter
                </button>
                @if(request()->anyFilled(['search', 'category']))
                    <a href="{{ route('projects.index') }}" class="bg-zinc-100 hover:bg-zinc-200 text-gray-700 py-3 px-4 rounded-2xl font-semibold text-sm flex items-center justify-center transition">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Project Cards Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($projects as $project)
            <a href="{{ route('projects.show', $project->id) }}"
               class="group bg-white rounded-3xl overflow-hidden border border-zinc-100 hover:border-accent-orange/30 shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <!-- Project Image -->
                    <div class="relative h-48 bg-zinc-200 overflow-hidden">
                        @if($project->display_image)
                            <img src="{{ asset($project->display_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-emerald-950/10 text-primary-green">
                                <i class="bi bi-image text-3xl"></i>
                            </div>
                        @endif
                        <span class="absolute top-4 left-4 bg-accent-orange text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-md">
                            {{ $project->category }}
                        </span>
                        
                        <span class="absolute top-4 right-4 bg-white/90 text-gray-800 text-xs px-3 py-1 rounded-full font-semibold shadow-sm backdrop-blur">
                            {{ $project->status }}
                        </span>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <span class="text-xs text-gray-400 font-semibold block mb-2">{{ $project->date }}</span>
                        <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2 group-hover:text-accent-orange transition-colors">{{ $project->title }}</h3>
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
            </a>
        @empty
            <div class="col-span-3 text-center py-24 bg-white rounded-3xl border border-zinc-100 text-gray-400">
                <i class="bi bi-search text-4xl block mb-4"></i>
                No programs found matching your search criteria.
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-12">
        {{ $projects->links() }}
    </div>
</div>
@endsection
