@extends('layouts.admin')

@section('title', 'Add Publication')
@section('page-title', 'Add New Publication')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow { border-radius: 0.55rem 0.55rem 0 0; border-color: #e2e8e2; background: #f8faf8; }
    .ql-container.ql-snow { border-radius: 0 0 0.55rem 0.55rem; border-color: #e2e8e2; font-size: 0.95rem; min-height: 280px; font-family: 'Outfit', sans-serif !important; }
    .ql-editor { min-height: 260px; }
    .ql-editor.ql-blank::before { font-style: normal; color: #adb5bd; }
    .form-section-title { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #6b7280; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #f1f5f1; }
    
    /* Image with Caption Styles */
    .ql-editor .image-with-caption {
        margin: 1.5rem auto;
        display: block;
        max-width: 100%;
        text-align: center;
    }
    .ql-editor .image-with-caption img {
        display: inline-block;
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        cursor: pointer;
    }
    .ql-editor .image-with-caption figcaption {
        margin-top: 0.5rem;
        padding: 0.4rem 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
        font-style: italic;
        text-align: center;
        background: #f8faf8;
        border-left: 3px solid #e2e8e2;
        border-radius: 0 0.25rem 0.25rem 0;
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    .ql-editor .image-with-caption figcaption:empty:before {
        content: attr(data-placeholder);
        color: #adb5bd;
    }
    .ql-editor .image-with-caption figcaption:focus {
        outline: none;
        background: #fff;
        border-left-color: #4ade80;
    }
    .ql-editor img:hover {
        outline: 2px dashed #4ade80;
        outline-offset: 2px;
    }
    .ql-editor .image-with-caption figcaption {
        margin-top: 0.5rem;
        padding: 0.4rem 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
        font-style: italic;
        text-align: center;
        background: #f8faf8;
        border-left: 3px solid #e2e8e2;
        border-radius: 0 0.25rem 0.25rem 0;
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    .ql-editor .image-with-caption figcaption:empty:before {
        content: attr(data-placeholder);
        color: #adb5bd;
    }
    .ql-editor .image-with-caption figcaption:focus {
        outline: none;
        background: #fff;
        border-left-color: #4ade80;
    }
    
    /* Image Resize Handles */
    .ql-editor img {
        cursor: pointer;
    }
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
                    <label class="form-label">Publication Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" placeholder="Enter publication title..." required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-0">
                    <label class="form-label">Ringkasan / Excerpt</label>
                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror"
                        rows="2" maxlength="500" placeholder="Short description for publication listing (max 500 chars)...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <!-- Editor -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="form-section-title">Publication Content <span class="text-danger">*</span></p>
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
                        <i class="bi bi-save me-1"></i> Save Publication
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-light">Batal</a>
                </div>
            </div>
        </div>

        <!-- Meta -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="form-section-title">Publication Meta</p>

                <div class="mb-3">
                    <label class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                        value="{{ old('author') }}" required>
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        <option value="Journal" {{ old('category') == 'Journal' ? 'selected' : '' }}>Journal</option>
                        <option value="Books" {{ old('category') == 'Books' ? 'selected' : '' }}>Books</option>
                        <option value="Intellectual Rights" {{ old('category') == 'Intellectual Rights' ? 'selected' : '' }}>Intellectual Rights</option>
                    </select>
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
    // Register custom YouTube blot and Image Caption blot
    const BlockEmbed = Quill.import('blots/block/embed');
    
    // Register custom Image with Caption blot
    class ImageCaptionBlot extends BlockEmbed {
        static create(value) {
            const node = super.create();
            const figure = document.createElement('figure');
            figure.setAttribute('class', 'image-with-caption');
            figure.setAttribute('contenteditable', 'false');
            
            const img = document.createElement('img');
            if (typeof value === 'string') {
                img.setAttribute('src', value);
            } else {
                img.setAttribute('src', value.url);
                if (value.alt) img.setAttribute('alt', value.alt);
            }
            
            const figcaption = document.createElement('figcaption');
            figcaption.setAttribute('contenteditable', 'true');
            figcaption.setAttribute('data-placeholder', 'Tambahkan caption (opsional)...');
            if (typeof value === 'object' && value.caption) {
                figcaption.textContent = value.caption;
            }
            
            // Prevent Quill from deleting the image when caption is edited
            figcaption.addEventListener('keydown', function(e) {
                // Always stop propagation so Quill doesn't intercept keyboard events in caption
                e.stopPropagation();
                
                // Enter: move cursor to new line after the image in editor
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const wrapper = node;
                    const blot = Quill.find(wrapper);
                    if (blot) {
                        const index = quill.getIndex(blot);
                        quill.insertText(index + 1, '\n', 'user');
                        quill.setSelection(index + 2, 0, 'user');
                    }
                    return;
                }
                
                // Backspace: if caption is empty, delete the entire image
                if (e.key === 'Backspace' || e.key === 'Delete') {
                    const text = figcaption.textContent.trim();
                    if (text === '') {
                        e.preventDefault();
                        const wrapper = node;
                        const blot = Quill.find(wrapper);
                        if (blot) {
                            blot.remove();
                        }
                        return;
                    }
                    
                    // If not empty, prevent backspace at position 0 to avoid deleting image
                    if (e.key === 'Backspace') {
                        const sel = window.getSelection();
                        if (sel && sel.rangeCount > 0) {
                            const range = sel.getRangeAt(0);
                            if (range.startOffset === 0 && range.collapsed) {
                                e.preventDefault();
                            }
                        }
                    }
                }
            });
            
            figcaption.addEventListener('keyup', function(e) { e.stopPropagation(); });
            figcaption.addEventListener('keypress', function(e) { e.stopPropagation(); });
            figcaption.addEventListener('mousedown', function(e) { e.stopPropagation(); });
            figcaption.addEventListener('click', function(e) { e.stopPropagation(); });
            
            figure.appendChild(img);
            figure.appendChild(figcaption);
            node.appendChild(figure);
            
            return node;
        }
        
        static value(node) {
            const figure = node.querySelector('figure');
            const img = figure.querySelector('img');
            const figcaption = figure.querySelector('figcaption');
            return {
                url: img.getAttribute('src'),
                alt: img.getAttribute('alt') || '',
                caption: figcaption.textContent
            };
        }
    }
    ImageCaptionBlot.blotName = 'imageCaption';
    ImageCaptionBlot.tagName = 'div';
    ImageCaptionBlot.className = 'image-caption-wrapper';
    Quill.register(ImageCaptionBlot);
    
    // YouTube Blot
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
        placeholder: 'Write publication content here...',
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
                                // Use imageCaption instead of image for better UX
                                quill.insertEmbed(range.index, 'imageCaption', { url: data.url, caption: '' });
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
        bodyTextarea.value = quill.getText().trim().length > 0 ? quill.root.innerHTML : '';
    });

    // Sync on form submit to capture resize changes (resize doesn't trigger text-change)
    const formElement = document.querySelector('form');
    if (formElement) {
        formElement.addEventListener('submit', function () {
            bodyTextarea.value = quill.getText().trim().length > 0 ? quill.root.innerHTML : '';
        });
    }

    // ── Image Resize ──────────────────────────────────────────────────────────
    let activeResizer = null;

    function attachResizer(img) {
        if (activeResizer) { activeResizer.remove(); activeResizer = null; }

        const wrapper = document.createElement('div');
        wrapper.className = 'img-resizer';
        wrapper.style.cssText = 'position:fixed;border:2px solid #4ade80;box-sizing:border-box;pointer-events:none;z-index:9999;';

        const sizeLabel = document.createElement('div');
        sizeLabel.style.cssText = 'position:absolute;bottom:-22px;left:50%;transform:translateX(-50%);background:#4ade80;color:#fff;padding:1px 7px;border-radius:4px;font-size:11px;white-space:nowrap;pointer-events:none;';

        function sync() {
            const ir = img.getBoundingClientRect();
            wrapper.style.left   = ir.left + 'px';
            wrapper.style.top    = ir.top  + 'px';
            wrapper.style.width  = ir.width  + 'px';
            wrapper.style.height = ir.height + 'px';
            sizeLabel.textContent = Math.round(img.offsetWidth) + ' × ' + Math.round(img.offsetHeight);
        }

        sync();

        const corners = { nw:['n','w'], ne:['n','e'], sw:['s','w'], se:['s','e'] };
        Object.entries(corners).forEach(([name, dirs]) => {
            const h = document.createElement('div');
            h.style.cssText = [
                'position:absolute',
                'width:12px','height:12px',
                'background:#4ade80',
                'border:2px solid #fff',
                'border-radius:50%',
                'cursor:' + name + '-resize',
                'pointer-events:all',
                'z-index:102',
                dirs.includes('n') ? 'top:-6px'    : 'bottom:-6px',
                dirs.includes('w') ? 'left:-6px'   : 'right:-6px',
            ].join(';');

            h.addEventListener('mousedown', function(ev) {
                ev.preventDefault();
                ev.stopPropagation();

                const x0 = ev.clientX;
                const w0 = img.offsetWidth;

                function onMove(ev) {
                    ev.preventDefault();
                    let dx = ev.clientX - x0;
                    if (dirs.includes('w')) dx = -dx;
                    const nw = Math.max(50, Math.min(w0 + dx, 800));
                    img.style.width  = nw + 'px';
                    img.style.height = 'auto';
                    img.setAttribute('width', Math.round(nw));
                    img.setAttribute('data-width', Math.round(nw));
                    img.removeAttribute('height');
                    sync();
                }
                function onUp(ev) {
                    ev.preventDefault();
                    document.removeEventListener('mousemove', onMove);
                    document.removeEventListener('mouseup', onUp);
                    document.body.style.cursor = '';
                }
                document.body.style.cursor = name + '-resize';
                document.addEventListener('mousemove', onMove);
                document.addEventListener('mouseup', onUp);
            });

            wrapper.appendChild(h);
        });

        wrapper.appendChild(sizeLabel);
        document.body.appendChild(wrapper);
        activeResizer = wrapper;
    }

    quill.root.addEventListener('mousedown', function(e) {
        if (e.target.tagName === 'IMG') {
            e.preventDefault();
            e.stopPropagation();
            attachResizer(e.target);
        }
    });

    // Also listen at document level with capture=true to catch events before Quill
    document.addEventListener('mousedown', function(e) {
        if (e.target.tagName === 'IMG' && e.target.closest('.ql-editor')) {
            e.preventDefault();
            attachResizer(e.target);
            return;
        }
        if (activeResizer && !e.target.closest('.img-resizer') && e.target.tagName !== 'IMG') {
            activeResizer.remove();
            activeResizer = null;
        }
    }, true); // capture phase - fires before Quill's handlers

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
