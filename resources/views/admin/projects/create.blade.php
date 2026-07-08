@extends('layouts.admin')

@section('title', 'Add Program')
@section('page-title', 'Add New Program')

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
<label for="category" class="form-label">Category <span class="text-danger">*</span></label>
<select id="category" class="form-select @error('category') is-invalid @enderror" name="category" required>
<option value="">-- Select Category --</option>
<option value="Research" {{ old('category') === 'Research' ? 'selected' : '' }}>Research</option>
<option value="Community Development" {{ old('category') === 'Community Development' ? 'selected' : '' }}>Community Development</option>
<option value="Capacity Building" {{ old('category') === 'Capacity Building' ? 'selected' : '' }}>Capacity Building</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
                    <label for="status" class="form-label">Project Status <span class="text-danger">*</span></label>
                    <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="author" class="form-label">Person in Charge / Author <span class="text-danger">*</span></label>
                    <input type="text" id="author" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="date" class="form-label">Implementation Date <span class="text-danger">*</span></label>
                    <input type="text" id="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="e.g. 12 Jan 2026 or Mar 2026" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="published_at" class="form-label">Publish Date <span class="text-danger">*</span></label>
                    <input type="date" id="published_at" class="form-control @error('published_at') is-invalid @enderror" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required>
                    <div class="form-text">Used for sorting programs. Can be set to a past date.</div>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="sdgs" class="form-label">SDGs Tags (separate with comma)</label>
                    <input type="text" id="sdgs" class="form-control @error('sdgs') is-invalid @enderror" name="sdgs" placeholder="e.g. SDG 7, SDG 13" value="{{ old('sdgs') }}">
                    @error('sdgs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="image" class="form-label">Main Program Photo <span class="text-muted fw-normal">(optional)</span></label>
                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, WEBP. Max 3MB.</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-2 d-none">
                        <img id="previewImg" src="#" class="rounded img-thumbnail" style="max-height: 150px;">
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Gallery Photos <span class="text-muted fw-normal">(optional, multiple allowed)</span></label>
                    <input type="file" id="galleryInput" class="form-control @error('images.*') is-invalid @enderror" name="images[]" accept="image/*" multiple>
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, PNG, WEBP. Max 3MB per photo. You can select multiple at once.</div>
                    <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                </div>

                <div class="col-12 mb-4">
                    <label for="description" class="form-label">Program Description <span class="text-danger">*</span></label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_pinned" id="is_pinned" value="1"
                            {{ old('is_pinned') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_pinned">
                            <i class="bi bi-pin-fill me-1"></i> Pin to top
                        </label>
                    </div>
                    <div class="form-text">Pinned programs appear first in the listing.</div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-light-secondary">Cancel</a>
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
