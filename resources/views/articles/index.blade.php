@extends('layouts.public')

@section('title', 'Our Publications')

@section('content')
<!-- Header -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-36 pb-20">
    <!-- Background photo with opacity -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=1920'); opacity: 0.6;"></div>
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/60 via-zinc-900/30 to-zinc-950/80 pointer-events-none"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-3 block">Writing & Insights</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-white">Our Publications</h1>
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
            <div class="md:col-span-3 relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search publications, authors, or topics..."
                    class="w-full pl-10 pr-4 py-3 rounded-2xl border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-primary-green text-sm">
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary-green hover:bg-emerald-800 text-white py-3 px-6 rounded-2xl font-semibold text-sm transition">
                    Search & Filter
                </button>
                @if(request('search'))
                    <a href="{{ route('articles.index') }}" class="bg-zinc-100 hover:bg-zinc-200 text-gray-600 py-3 px-4 rounded-2xl font-semibold text-sm transition flex items-center justify-center">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Publications Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-24 space-y-12">
    
    <!-- Tab Switcher -->
    <div class="flex justify-center mb-4">
        <div class="inline-flex p-1.5 bg-zinc-100/80 backdrop-blur rounded-2xl border border-zinc-200">
            <a href="{{ route('articles.index', array_merge(request()->query(), ['tab' => 'jurnal', 'page' => 1])) }}"
               class="px-6 py-2.5 rounded-xl text-sm font-extrabold transition-all duration-200 flex items-center gap-2
               {{ $tab === 'jurnal' ? 'bg-white text-emerald-800 shadow-sm border border-zinc-100' : 'text-zinc-500 hover:text-zinc-900' }}">
                <i class="bi bi-journal-text text-base"></i>
                Jurnal & Artikel
            </a>
            <a href="{{ route('articles.index', array_merge(request()->query(), ['tab' => 'buku', 'page' => 1])) }}"
               class="px-6 py-2.5 rounded-xl text-sm font-extrabold transition-all duration-200 flex items-center gap-2
               {{ $tab === 'buku' ? 'bg-white text-emerald-800 shadow-sm border border-zinc-100' : 'text-zinc-500 hover:text-zinc-900' }}">
                <i class="bi bi-book text-base"></i>
                Buku & Modul
            </a>
        </div>
    </div>

    @if($tab === 'buku')
        <!-- Section 2: Buku (Books) -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-zinc-900">Buku & Publikasi Buku</h2>
                    <p class="text-xs text-zinc-500 mt-1">Buku referensi, panduan, dan modul pembelajaran keberlanjutan</p>
                </div>
                <span class="text-xs font-semibold px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200">
                    {{ $books->total() }} Buku
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($books as $book)
                    <a href="{{ route('articles.show', $book->slug) }}" 
                       class="group bg-white rounded-3xl overflow-hidden border border-zinc-100 hover:border-emerald-500/30 hover:shadow-md transition-all duration-300 flex flex-col hover:-translate-y-1">
                        <!-- Thumbnail Book Cover Layout -->
                        <div class="relative h-64 bg-zinc-50 flex items-center justify-center overflow-hidden border-b border-zinc-100">
                            @if($book->thumbnail)
                                <img src="{{ asset($book->thumbnail) }}" alt="{{ $book->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <!-- Custom CSS-based book cover -->
                                <div class="w-full h-full bg-gradient-to-br from-emerald-800 to-zinc-900 flex flex-col items-center justify-center text-white p-6 text-center relative">
                                    <!-- Spine detail decoration -->
                                    <div class="absolute left-0 top-0 bottom-0 w-2.5 bg-black/20"></div>
                                    <i class="bi bi-book-half text-5xl mb-3 text-emerald-400"></i>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-300 mb-1">RCE PUBLICATION</span>
                                    <span class="font-extrabold text-sm line-clamp-3 leading-tight px-3">{{ $book->title }}</span>
                                </div>
                            @endif
                            <span class="absolute top-4 right-4 bg-emerald-700/90 text-white text-[10px] font-bold px-2.5 py-1 rounded">
                                {{ $book->category }}
                            </span>
                        </div>

                        <!-- Book Details -->
                        <div class="p-6 flex flex-col flex-1">
                            <span class="text-xs text-zinc-400 font-semibold mb-2">
                                {{ $book->published_at?->translatedFormat('d M Y') ?? '-' }}
                            </span>
                            <h3 class="font-bold text-lg text-zinc-900 group-hover:text-emerald-700 transition-colors mb-2 line-clamp-2 leading-snug">
                                {{ $book->title }}
                            </h3>
                            <div class="flex items-center gap-1.5 text-xs text-zinc-500 mb-3">
                                <i class="bi bi-person text-base text-emerald-600"></i>
                                Penulis: <span class="font-semibold text-zinc-700">{{ $book->author }}</span>
                            </div>
                            <p class="text-sm text-zinc-600 line-clamp-3 leading-relaxed flex-1">
                                {{ $book->excerpt ?? Str::limit(strip_tags($book->body), 120) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-zinc-100 text-gray-400">
                        <i class="bi bi-book text-4xl block mb-3"></i>
                        Tidak ada buku yang ditemukan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination Buku -->
            @if($books->hasPages())
                <div class="mt-10">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Section 1: Jurnal (Journals) -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-zinc-900">Jurnal & Artikel Ilmiah</h2>
                    <p class="text-xs text-zinc-500 mt-1">Daftar jurnal, hasil penelitian, dan artikel ilmiah RCE East Java</p>
                </div>
                <span class="text-xs font-semibold px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200">
                    {{ $journals->total() }} Dokumen
                </span>
            </div>

            <div class="space-y-4">
                @forelse($journals as $journal)
                    <a href="{{ route('articles.show', $journal->slug) }}" 
                       class="group block bg-white p-6 rounded-3xl border border-zinc-100 hover:border-emerald-500/30 hover:shadow-md transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded bg-zinc-100 text-zinc-600">
                                        {{ $journal->category }}
                                    </span>
                                    <span class="text-xs text-zinc-400 font-medium">
                                        {{ $journal->published_at?->translatedFormat('d M Y') ?? '-' }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg text-zinc-900 group-hover:text-emerald-700 transition-colors mb-1">
                                    {{ $journal->title }}
                                </h3>
                                <div class="flex items-center gap-1.5 text-xs text-zinc-500 mb-3">
                                    <i class="bi bi-person text-base text-emerald-600"></i>
                                    Penulis: <span class="font-semibold text-zinc-700">{{ $journal->author }}</span>
                                </div>
                                <p class="text-sm text-zinc-600 line-clamp-2 leading-relaxed">
                                    {{ $journal->excerpt ?? Str::limit(strip_tags($journal->body), 180) }}
                                </p>
                            </div>
                            <div class="flex-shrink-0 flex items-center self-end md:self-center">
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-zinc-50 group-hover:bg-emerald-50 text-zinc-400 group-hover:text-emerald-700 transition-colors shadow-sm">
                                    <i class="bi bi-arrow-right"></i>
                                 </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-16 bg-white rounded-3xl border border-zinc-100 text-gray-400">
                        <i class="bi bi-journal-text text-4xl block mb-3"></i>
                        Tidak ada jurnal yang ditemukan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination Jurnal -->
            @if($journals->hasPages())
                <div class="mt-8">
                    {{ $journals->links() }}
                </div>
            @endif
        </div>
    @endif

</div>
@endsection
