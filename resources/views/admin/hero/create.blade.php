@extends('layouts.admin')

@section('title', 'Tambah Foto Hero')
@section('page-title', 'Tambah Foto Hero')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Tambah Foto Hero</h4>
        <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="form-label fw-semibold">Foto Hero <span class="text-danger">*</span></label>
                <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/webp" required>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Format: JPG, PNG, WEBP. Maks 3MB. Disarankan rasio 16:9 (misal 1920x1080px).</div>

                {{-- Preview --}}
                <div id="imagePreview" class="mt-3 d-none">
                    <p class="small text-muted mb-1">Preview:</p>
                    <img id="previewImg" src="#" alt="Preview"
                        class="rounded border" style="max-height: 200px; object-fit: cover;">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Caption <span class="text-muted fw-normal">(opsional)</span></label>
                <input type="text" name="caption" class="form-control @error('caption') is-invalid @enderror"
                    value="{{ old('caption') }}" placeholder="Contoh: Kegiatan RCE di Surabaya...">
                @error('caption')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', 0) }}" min="0" max="99">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Angka lebih kecil tampil lebih awal.</div>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-center">
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="isActive">Aktifkan Foto</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Foto
                </button>
                <a href="{{ route('admin.hero.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('imagePreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
