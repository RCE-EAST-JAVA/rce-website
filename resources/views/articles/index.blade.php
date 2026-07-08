@extends('layouts.public')

@section('title', 'Publications')

@section('content')
<!-- Header -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-36 pb-20">
    <!-- Background gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-emerald-950/40 to-zinc-950 pointer-events-none"></div>
    <!-- Decorative blobs -->
    <div class="absolute top-10 right-20 w-80 h-80 rounded-full bg-emerald-500/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-56 h-56 rounded-full bg-emerald-400/5 blur-2xl pointer-events-none"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-3 block">Writing & Insights</span>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-white">Publications</h1>
        <div class="w-12 h-1 bg-accent-orange rounded-full mb-5"></div>
        <p class="text-zinc-400 max-w-2xl text-sm md:text-base leading-relaxed">
            A collection of research, insights, and publications on sustainability, SDGs, and environmental initiatives in East Java.
        </p>
    </div>
</div>

<!-- Search & Filter -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm">
        <form action="{{ route('articles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2 relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search publications, authors, or topics..."
                    class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>
            </div>

            <div>
                <select name="category" class="w-full py-3 px-4 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary-green hover-bg-primary-green text-white py-3 px-6 rounded-2xl font-semibold text-sm transition">
                    Cari & Filter
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('articles.index') }}" class="bg-zinc-100 hover:bg-zinc-200 text-gray-600 py-3 px-4 rounded-2xl font-semibold text-sm transition">
                        ×
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Article Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}"
               class="group bg-white rounded-3xl overflow-hidden border border-zinc-100 hover:border-accent-orange/30 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 flex flex-col">
                <!-- Thumbnail -->
                <div class="relative h-48 bg-zinc-100 overflow-hidden">
                    @if($article->thumbnail)
                        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-950/5 text-primary-green">
                            <i class="bi bi-newspaper text-4xl opacity-30"></i>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-accent-orange text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                        {{ $article->category }}
                    </span>
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-1">
                    <span class="text-xs text-gray-400 font-semibold block mb-2">
                        {{ $article->published_at?->translatedFormat('d M Y') ?? '-' }}
                    </span>
                    <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2 group-hover:text-accent-orange transition-colors">
                        {{ $article->title }}
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed flex-1">
                        {{ $article->excerpt ?? Str::limit(strip_tags($article->body), 120) }}
                    </p>

                    <!-- Tags -->
                    @if($article->tags)
                        <div class="flex flex-wrap gap-1 mt-4">
                            @foreach($article->tags_array as $tag)
                                <span class="text-[10px] bg-accent-orange/10 text-accent-orange font-bold px-2 py-0.5 rounded">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="px-6 pb-5 pt-3 border-t border-zinc-100 flex items-center justify-between bg-zinc-50/50">
                    <span class="text-xs text-gray-500 font-medium flex items-center gap-1.5">
                        <i class="bi bi-person-fill text-primary-green"></i>
                        {{ $article->author }}
                    </span>
                    <span class="text-xs font-semibold text-primary-green flex items-center gap-1">
                        Baca <i class="bi bi-arrow-right"></i>
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-24 bg-white rounded-3xl border border-zinc-100 text-gray-400">
                <i class="bi bi-newspaper text-4xl block mb-4"></i>
                        No publications match your search.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</div>
@endsection
