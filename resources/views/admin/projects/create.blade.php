@extends('layouts.admin')

@section('title', 'Tambah Proyek')
@section('page-title', 'Tambah Proyek Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Input Data Proyek</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label for="title" class="form-label">Judul Proyek <span class="text-danger">*</span></label>
                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
                    <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select id="category" class="form-select @error('category') is-invalid @enderror" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Sampah" {{ old('category') === 'Sampah' ? 'selected' : '' }}>Sampah</option>
                        <option value="Air" {{ old('category') === 'Air' ? 'selected' : '' }}>Air</option>
                        <option value="Energi" {{ old('category') === 'Energi' ? 'selected' : '' }}>Energi</option>
                        <option value="Sosial" {{ old('category') === 'Sosial' ? 'selected' : '' }}>Sosial/Edukasi</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
                    <label for="status" class="form-label">Status Proyek <span class="text-danger">*</span></label>
                    <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="author" class="form-label">Penanggung Jawab / Penulis <span class="text-danger">*</span></label>
                    <input type="text" id="author" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="date" class="form-label">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                    <input type="text" id="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="Contoh: 12 Jan 2026 atau Mar 2026" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="published_at" class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="date" id="published_at" class="form-control @error('published_at') is-invalid @enderror" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required>
                    <div class="form-text">Digunakan untuk mengurutkan proyek. Bisa diset ke tanggal masa lalu.</div>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="sdgs" class="form-label">Tag SDGs (Pisahkan dengan koma)</label>
                    <input type="text" id="sdgs" class="form-control @error('sdgs') is-invalid @enderror" name="sdgs" placeholder="Contoh: SDG 7, SDG 13" value="{{ old('sdgs') }}">
                    @error('sdgs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="image" class="form-label">Foto Utama Proyek <span class="text-muted fw-normal">(opsional)</span></label>
                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, WEBP. Maks 3MB.</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-2 d-none">
                        <img id="previewImg" src="#" class="rounded img-thumbnail" style="max-height: 150px;">
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Foto Galeri <span class="text-muted fw-normal">(opsional, bisa lebih dari satu)</span></label>
                    <input type="file" id="galleryInput" class="form-control @error('images.*') is-invalid @enderror" name="images[]" accept="image/*" multiple>
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, PNG, WEBP. Maks 3MB per foto. Bisa pilih beberapa sekaligus.</div>
                    <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                </div>

                <div class="col-12 mb-4">
                    <label for="description" class="form-label">Deskripsi Proyek <span class="text-danger">*</span></label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-light-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview cover image
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('imagePreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });

    // Preview gallery images
    document.getElementById('galleryInput').addEventListener('change', function(e) {
        const container = document.getElementById('galleryPreview');
        container.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'rounded img-thumbnail';
                img.style.maxHeight = '100px';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
