@extends('layouts.public')

@section('title', $article->title)

@section('styles')
<style>
    /* Prose styling untuk konten Quill */
    .article-body { word-break: break-word; overflow-wrap: break-word; overflow: hidden; }
    .article-body h1 { font-size: 1.875rem; font-weight: 800; margin: 1.5rem 0 0.75rem; color: #111827; line-height: 1.3; }
    .article-body h2 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 0.75rem; color: #111827; line-height: 1.3; }
    .article-body h3 { font-size: 1.25rem; font-weight: 700; margin: 1.25rem 0 0.6rem; color: #1f2937; line-height: 1.4; }
    .article-body p  { margin: 0 0 1rem; line-height: 1.8; color: #374151; }
    .article-body ul { list-style: disc; padding-left: 1.5rem; margin: 0 0 1rem; }
    .article-body ol { list-style: decimal; padding-left: 1.5rem; margin: 0 0 1rem; }
    .article-body li { margin-bottom: 0.35rem; line-height: 1.7; color: #374151; }
    .article-body blockquote {
        border-left: 4px solid #1e4620;
        background: #f0fdf4;
        padding: 1rem 1.25rem;
        margin: 1.25rem 0;
        border-radius: 0 0.75rem 0.75rem 0;
        color: #374151;
        font-style: italic;
    }
    .article-body pre {
        background: #1e293b;
        color: #e2e8f0;
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        overflow-x: auto;
        margin: 1.25rem 0;
        font-size: 0.875rem;
        line-height: 1.6;
    }
    .article-body code {
        background: #f1f5f9;
        color: #0f172a;
        padding: 0.15rem 0.4rem;
        border-radius: 0.3rem;
        font-size: 0.875rem;
    }
    .article-body pre code { background: none; color: inherit; padding: 0; }
    .article-body a  { color: #1e4620; text-decoration: underline; font-weight: 500; }
    .article-body a:hover { color: #d97724; }
    .article-body strong { font-weight: 700; color: #111827; }
    .article-body em { font-style: italic; }
    .article-body s  { text-decoration: line-through; color: #6b7280; }
    .article-body hr { border: none; border-top: 1px solid #e5e7eb; margin: 2rem 0; }
    .article-body img { max-width: 100%; border-radius: 0.75rem; margin: 1rem 0; }
    /* Force inline style width to be respected - override Tailwind preflight */
    .article-body .image-with-caption img[style] { max-width: none !important; }
    
    /* Image with Caption - Frontend Display */
    .article-body .image-caption-wrapper {
        display: block;
        text-align: center;
        margin: 1.5rem 0;
    }
    .article-body .image-with-caption {
        display: inline-block;
        max-width: 100%;
        text-align: center;
    }
    .article-body .image-with-caption img {
        display: block;
        max-width: 100%;
        height: auto !important;
        border-radius: 0.75rem;
        margin: 0 auto;
    }
    .article-body .image-with-caption figcaption {
        margin-top: 0.75rem;
        padding: 0.4rem 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
        font-style: italic;
        text-align: center;
        background: #f8faf8;
        border-left: 3px solid #1e4620;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .article-body .image-with-caption figcaption:empty {
        display: none;
    }
</style>
@endsection

@section('content')
<!-- Hero Header -->
<div class="relative bg-zinc-950 text-white overflow-hidden pt-36 pb-16">
    <!-- Background gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-emerald-950/40 to-zinc-950 pointer-events-none"></div>
    <!-- Decorative blobs -->
    <div class="absolute top-10 right-20 w-80 h-80 rounded-full bg-emerald-500/5 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-56 h-56 rounded-full bg-emerald-400/5 blur-2xl pointer-events-none"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-emerald-400 mb-6 font-semibold uppercase tracking-widest flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <span class="opacity-50">/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-white transition">Publications</a>
            <span class="opacity-50">/</span>
            <span class="text-white/60 normal-case font-normal tracking-normal">{{ Str::limit($article->title, 40) }}</span>
        </nav>

        <span class="inline-block bg-white/15 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full mb-5">
            {{ $article->category }}
        </span>

        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6">
            {{ $article->title }}
        </h1>

        <div class="flex flex-wrap items-center gap-5 text-sm text-white/60">
            <span class="flex items-center gap-2">
                <i class="bi bi-person-fill text-emerald-400"></i>
                {{ $article->author }}
            </span>
            <span class="flex items-center gap-2">
                <i class="bi bi-calendar3 text-emerald-400"></i>
                {{ $article->published_at?->translatedFormat('d M Y') ?? '-' }}
            </span>
            @if($article->tags)
                <span class="flex items-center gap-2 flex-wrap">
                    <i class="bi bi-tags text-emerald-400"></i>
                    @foreach($article->tags_array as $tag)
                        <span class="bg-white/10 text-white/80 text-xs font-semibold px-2 py-0.5 rounded">{{ $tag }}</span>
                    @endforeach
                </span>
            @endif
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

    <!-- Thumbnail -->
    @if($article->thumbnail)
        <div class="rounded-3xl overflow-hidden mb-10 shadow-lg border border-zinc-100 cursor-zoom-in group relative"
             onclick="openLightbox('{{ asset($article->thumbnail) }}', '{{ $article->title }}')">
            <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                 class="w-full object-cover max-h-[500px] transition-transform duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/90 rounded-full p-3 shadow-lg">
                    <i class="bi bi-zoom-in text-2xl text-gray-700"></i>
                </div>
            </div>
        </div>

        <!-- Lightbox -->
        <div id="lightbox" class="fixed inset-0 z-[9999] bg-black/90 flex items-center justify-center p-4 hidden"
             onclick="closeLightbox(event)">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
                <i class="bi bi-x-lg text-3xl"></i>
            </button>
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-2xl">
        </div>

        <script>
            function openLightbox(src, alt) {
                const lb = document.getElementById('lightbox');
                const img = document.getElementById('lightbox-img');
                img.src = src;
                img.alt = alt;
                lb.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            function closeLightbox(event) {
                if (event && event.target !== document.getElementById('lightbox') && !event.target.closest('button')) return;
                document.getElementById('lightbox').classList.add('hidden');
                document.body.style.overflow = '';
            }
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.getElementById('lightbox').classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        </script>
    @endif

    <!-- Excerpt -->
    @if($article->excerpt)
        <div class="bg-emerald-50 border-l-4 rounded-2xl p-6 mb-8 text-gray-700 italic leading-relaxed text-base"
             style="border-color: #1e4620;">
            {{ $article->excerpt }}
        </div>
    @endif

    <!-- Body -->
    <div class="bg-white rounded-3xl border border-zinc-100 shadow-sm p-8 md:p-12 mb-10">
        <div class="article-body text-base" id="article-content">
            {!! $article->body !!}
        </div>
    </div>
    
    <script>
        // Remove contenteditable from all figcaptions in article body
        document.addEventListener('DOMContentLoaded', function() {
            const captions = document.querySelectorAll('.article-body figcaption');
            captions.forEach(caption => {
                caption.removeAttribute('contenteditable');
                caption.style.cursor = 'default';
            });
            
            // Apply width from width attribute to inline style
            const images = document.querySelectorAll('.article-body img[width]');
            console.log('Found images with width attribute:', images.length);
            
            images.forEach(img => {
                const w = img.getAttribute('width');
                console.log('Processing image, width attribute:', w, 'current computed width:', window.getComputedStyle(img).width);
                
                if (w && !isNaN(w)) {
                    img.style.setProperty('width', w + 'px', 'important');
                    img.style.setProperty('height', 'auto', 'important');
                    img.style.setProperty('max-width', w + 'px', 'important');
                    
                    console.log('Applied width:', w + 'px', 'new computed width:', window.getComputedStyle(img).width);
                }
            });
        });
    </script>

    <!-- Tags -->
    @if($article->tags)
        <div class="flex flex-wrap items-center gap-2 mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-gray-400 mr-1">Tags:</span>
            @foreach($article->tags_array as $tag)
                <a href="{{ route('articles.index', ['search' => $tag]) }}"
                   class="text-xs font-bold px-3 py-1 rounded-full transition"
                   style="background: rgba(217,119,36,0.1); color: #d97724;">
                    {{ $tag }}
                </a>
            @endforeach
        </div>
    @endif

    <!-- Back + Meta row -->
    <div class="flex flex-wrap items-center justify-between gap-4 pt-8 border-t border-zinc-100">
        <a href="{{ route('articles.index') }}"
           class="flex items-center gap-2 text-gray-500 hover:text-primary-green font-semibold text-sm transition">
            <i class="bi bi-arrow-left"></i>
                        Back to Publications List
        </a>
        <div class="flex items-center gap-4 text-xs text-gray-400">
            <span class="flex items-center gap-1">
                <i class="bi bi-person-fill"></i> {{ $article->author }}
            </span>
            <span class="flex items-center gap-1">
                <i class="bi bi-calendar3"></i>
                {{ $article->published_at?->translatedFormat('d M Y') ?? '-' }}
            </span>
        </div>
    </div>
</div>

<!-- Related Articles -->
@if($related->isNotEmpty())
<div class="bg-zinc-50 border-t border-zinc-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <span class="text-xs font-bold uppercase tracking-widest mb-2 block" style="color:#1e4620;">Kategori Serupa</span>
                    <h2 class="text-2xl font-extrabold text-gray-900">Related Publications</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('articles.show', $rel->slug) }}"
               class="group bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 flex flex-col">
                <div class="relative h-44 bg-zinc-100 overflow-hidden">
                    @if($rel->thumbnail)
                        <img src="{{ asset($rel->thumbnail) }}" alt="{{ $rel->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-950/5">
                            <i class="bi bi-newspaper text-4xl text-zinc-300"></i>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 text-white text-[10px] font-bold px-2.5 py-1 rounded-full" style="background:#1e4620;">
                        {{ $rel->category }}
                    </span>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <span class="text-xs text-gray-400 mb-1">{{ $rel->published_at?->translatedFormat('d M Y') }}</span>
                    <h3 class="font-bold text-gray-900 line-clamp-2 mb-2 group-hover:text-primary-green transition-colors">
                        {{ $rel->title }}
                    </h3>
                    <p class="text-sm text-gray-500 line-clamp-2 flex-1">
                        {{ $rel->excerpt ?? Str::limit(strip_tags($rel->body), 100) }}
                    </p>
                    <span class="mt-4 text-xs font-semibold flex items-center gap-1" style="color:#1e4620;">
                            Read Publication <i class="bi bi-arrow-right"></i>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
