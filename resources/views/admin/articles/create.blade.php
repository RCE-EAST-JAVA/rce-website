@extends('layouts.admin')

@section('title', 'Tambah Artikel')
@section('page-title', 'Tambah Artikel Baru')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow { border-radius: 0.55rem 0.55rem 0 0; border-color: #e2e8e2; background: #f8faf8; }
    .ql-container.ql-snow { border-radius: 0 0 0.55rem 0.55rem; border-color: #e2e8e2; font-size: 0.95rem; min-height: 280px; font-family: 'Outfit', sans-serif !important; }
    .ql-editor { min-height: 260px; }
    .ql-editor.ql-blank::before { font-style: normal; color: #adb5bd; }
    .form-section-title { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #6b7280; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #f1f5f1; }
</style>
@endsection

@section('content')
<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
@csrf

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start gap-2 mb-4">
        <i class="bi bi-exclamation-circle-fill mt-1"></i>
        <div>
            <strong>Terdapat kesalahan:</strong>
            <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4">

    <!-- Kolom Kiri: Konten Utama -->
    <div class="col-lg-8">

        <!-- Judul -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="form-section-title">Informasi Dasar</p>
                <div class="mb-3">
                    <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" placeholder="Masukkan judul artikel..." required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-0">
                    <label class="form-label">Ringkasan / Excerpt</label>
                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror"
                        rows="2" maxlength="500" placeholder="Deskripsi singkat yang tampil di daftar artikel (maks 500 karakter)...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <!-- Editor -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="form-section-title">Isi Artikel <span class="text-danger">*</span></p>
                @error('body')<div class="alert alert-danger py-2 small mb-3">{{ $message }}</div>@enderror
                <div id="quill-editor"></div>
                <textarea name="body" id="body" class="d-none">{{ old('body') }}</textarea>
            </div>
        </div>

    </div>

    <!-- Kolom Kanan: Sidebar -->
    <div class="col-lg-4">

        <!-- Tombol Aksi -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Artikel
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-light">Batal</a>
                </div>
            </div>
        </div>

        <!-- Meta -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="form-section-title">Meta Artikel</p>

                <div class="mb-3">
                    <label class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                        value="{{ old('author') }}" required>
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                        value="{{ old('category') }}" placeholder="Cth: Lingkungan, Energi..." required>
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror"
                        value="{{ old('tags') }}" placeholder="Pisahkan dengan koma">
                    @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Cth: SDGs, Lingkungan, Air</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label class="form-label">Tanggal Publish</label>
                    <input type="date" name="published_at" class="form-control @error('published_at') is-invalid @enderror"
                        value="{{ old('published_at') }}">
                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Kosongkan untuk menggunakan tanggal sekarang.</div>
                </div>
            </div>
        </div>

        <!-- Thumbnail -->
        <div class="card">
            <div class="card-body">
                <p class="form-section-title">Thumbnail</p>
                <div id="thumbPreview" class="mb-3 d-none">
                    <img id="thumbImg" src="#" alt="Preview"
                         class="rounded w-100" style="max-height: 160px; object-fit: cover;">
                </div>
                <input type="file" name="thumbnail" id="thumbnailInput"
                    class="form-control @error('thumbnail') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/webp">
                @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text mt-1">JPG, PNG, WEBP. Maks 3MB. Rasio 16:9.</div>
            </div>
        </div>

    </div>
</div>

</form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<style>
    /* Custom YouTube button di toolbar */
    .ql-youtube {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }
    .ql-youtube svg {
        width: 18px;
        height: 14px;
        pointer-events: none;
    }
</style>
<script>
    // Register custom YouTube blot
    const BlockEmbed = Quill.import('blots/block/embed');
    class YouTubeBlot extends BlockEmbed {
        static create(url) {
            const node = super.create();
            let videoId = '';
            const match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([a-zA-Z0-9_-]{11})/);
            if (match) videoId = match[1];
            node.setAttribute('src', `https://www.youtube.com/embed/${videoId}`);
            node.setAttribute('frameborder', '0');
            node.setAttribute('allowfullscreen', 'true');
            node.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            node.style.cssText = 'width:100%;aspect-ratio:16/9;border-radius:0.75rem;margin:1rem 0;display:block;';
            return node;
        }
        static value(node) { return node.getAttribute('src'); }
    }
    YouTubeBlot.blotName = 'youtube';
    YouTubeBlot.tagName = 'iframe';
    YouTubeBlot.className = 'ql-youtube-embed';
    Quill.register(YouTubeBlot);

    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tulis isi artikel di sini...',
        modules: {
            toolbar: {
                container: [
                    [{ header: [2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image', 'youtube'],
                    ['clean']
                ],
                handlers: {
                    image: function () {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/jpeg,image/png,image/jpg,image/webp,image/gif');
                        input.click();
                        input.onchange = async () => {
                            const file = input.files[0];
                            if (!file) return;
                            const formData = new FormData();
                            formData.append('image', file);
                            formData.append('_token', '{{ csrf_token() }}');
                            try {
                                const res = await fetch('{{ route('admin.articles.upload-image') }}', {
                                    method: 'POST',
                                    body: formData,
                                });
                                const data = await res.json();
                                const range = quill.getSelection(true);
                                quill.insertEmbed(range.index, 'image', data.url);
                                quill.setSelection(range.index + 1);
                            } catch (e) {
                                alert('Gagal mengupload gambar. Coba lagi.');
                            }
                        };
                    },
                    youtube: function () {
                        const url = prompt('Masukkan URL YouTube:');
                        if (!url) return;
                        const range = quill.getSelection(true);
                        quill.insertEmbed(range.index, 'youtube', url, 'user');
                        quill.setSelection(range.index + 1);
                    }
                }
            }
        }
    });

    // Inject YouTube SVG icon ke toolbar button
    document.querySelector('.ql-youtube').innerHTML = '<svg viewBox="0 0 24 24" width="18" height="14" xmlns="http://www.w3.org/2000/svg"><path fill="#FF0000" d="M23.5 6.2s-.2-1.6-.9-2.3c-.9-.9-1.9-.9-2.3-1C17.4 2.7 12 2.7 12 2.7s-5.4 0-8.3.2c-.4.1-1.4.1-2.3 1-.7.7-.9 2.3-.9 2.3S.3 8 .3 9.8v1.7c0 1.8.2 3.6.2 3.6s.2 1.6.9 2.3c.9.9 2 .9 2.6 1C5.8 18.6 12 18.7 12 18.7s5.4 0 8.3-.3c.4-.1 1.4-.1 2.3-1 .7-.7.9-2.3.9-2.3s.2-1.8.2-3.6V9.8c0-1.8-.2-3.6-.2-3.6zM9.7 14.5V8.2l6.3 3.2-6.3 3.1z"/></svg>';

    const bodyTextarea = document.getElementById('body');

    if (bodyTextarea.value.trim()) {
        quill.clipboard.dangerouslyPasteHTML(bodyTextarea.value);
    }

    quill.on('text-change', function () {
        bodyTextarea.value = quill.getText().trim().length > 0 ? quill.getSemanticHTML() : '';
    });

    // Auto-fill tanggal publish
    const statusSelect = document.querySelector('select[name="status"]');
    const publishedAtInput = document.querySelector('input[name="published_at"]');
    statusSelect.addEventListener('change', function () {
        if (this.value === 'published' && !publishedAtInput.value) {
            publishedAtInput.value = new Date().toISOString().split('T')[0];
        }
        if (this.value === 'draft') publishedAtInput.value = '';
    });

    document.getElementById('thumbnailInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            document.getElementById('thumbImg').src = ev.target.result;
            document.getElementById('thumbPreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
