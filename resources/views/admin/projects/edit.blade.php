@extends('layouts.admin')

@section('title', 'Edit Program')
@section('page-title', 'Edit Program')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Data Proyek</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label for="title" class="form-label">Judul Proyek <span class="text-danger">*</span></label>
                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $project->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
<label for="category" class="form-label">Category <span class="text-danger">*</span></label>
<select id="category" class="form-select @error('category') is-invalid @enderror" name="category" required>
<option value="">-- Select Category --</option>
<option value="Research" {{ old('category', $project->category) === 'Research' ? 'selected' : '' }}>Research</option>
<option value="Community Development" {{ old('category', $project->category) === 'Community Development' ? 'selected' : '' }}>Community Development</option>
<option value="Capacity Building" {{ old('category', $project->category) === 'Capacity Building' ? 'selected' : '' }}>Capacity Building</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
                    <label for="status" class="form-label">Program Status <span class="text-danger">*</span></label>
                    <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="Aktif" {{ old('status', $project->status) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Selesai" {{ old('status', $project->status) === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="author" class="form-label">Person in Charge / Author <span class="text-danger">*</span></label>
                    <input type="text" id="author" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author', $project->author) }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="date" class="form-label">Implementation Date <span class="text-danger">*</span></label>
                    <input type="text" id="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="e.g. 12 Jan 2026 or Mar 2026" value="{{ old('date', $project->date) }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="published_at" class="form-label">Publish Date <span class="text-danger">*</span></label>
                    <input type="date" id="published_at" class="form-control @error('published_at') is-invalid @enderror" name="published_at" value="{{ old('published_at', $project->published_at ? $project->published_at->format('Y-m-d') : date('Y-m-d')) }}" required>
                    <div class="form-text">Used for sorting programs. Can be set to a past date.</div>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="sdgs" class="form-label">SDGs Tags (separate with comma)</label>
                    <input type="text" id="sdgs" class="form-control @error('sdgs') is-invalid @enderror" name="sdgs" placeholder="e.g. SDG 7, SDG 13" value="{{ old('sdgs', $project->sdgs) }}">
                    @error('sdgs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="image" class="form-label">Main Program Photo <span class="text-muted fw-normal">(leave empty to keep current)</span></label>
                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, WEBP. Max 3MB.</div>
                    @if($project->image)
                        <div class="mt-2">
                            <span class="text-muted d-block mb-1">Current Photo:</span>
                            <img src="{{ asset($project->image) }}" class="rounded img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-2 d-none">
                        <img id="previewImg" src="#" class="rounded img-thumbnail" style="max-height: 150px;">
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Gallery Photos</label>

                    @if($project->images->isNotEmpty())
                        <div class="mb-3">
                            <span class="text-muted d-block mb-2">Click a photo to mark it for deletion:</span>
                            <div class="d-flex flex-wrap gap-2" id="galleryExisting">
                                @foreach($project->images as $img)
                                <div class="position-relative border rounded p-1 bg-light gallery-item"
                                     style="width: 140px; cursor: pointer;"
                                     onclick="toggleDelete(this, {{ $img->id }})">
                                    <img src="{{ asset($img->image) }}" class="rounded d-block"
                                        style="width: 100%; height: 100px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 end-0 bottom-0 bg-danger bg-opacity-50 rounded d-none align-items-center justify-content-center delete-overlay">
                                        <i class="bi bi-trash3-fill text-white fs-4"></i>
                                    </div>
                                    <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"
                                        class="d-none" data-id="{{ $img->id }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <label class="form-label fw-semibold mt-2">Add New Photos</label>
                    <input type="file" id="galleryInput" class="form-control @error('images.*') is-invalid @enderror"
                        name="images[]" accept="image/*" multiple>
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">You can select multiple files. Format: JPG, PNG, WEBP. Max 3MB.</div>
                    <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                </div>

                <style>
                    .gallery-item.selected .delete-overlay { display: flex !important; }
                    .gallery-item.selected { border-color: #dc3545 !important; background: #fce4ec !important; }
                </style>

                <div class="col-12 mb-4">
                    <label for="description" class="form-label">Project Description <span class="text-danger">*</span></label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_pinned" id="is_pinned" value="1"
                            {{ old('is_pinned', $project->is_pinned) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_pinned">
                            <i class="bi bi-pin-fill me-1"></i> Pin to top
                        </label>
                    </div>
                    <div class="form-text">Pinned programs appear first in the listing.</div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-light-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle delete gallery image
    function toggleDelete(el, id) {
        el.classList.toggle('selected');
        const cb = el.querySelector('input[type="checkbox"]');
        if (cb) cb.checked = !cb.checked;
    }

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

    // Preview new gallery images
    document.getElementById('galleryInput').addEventListener('change', function(e) {
        const container = document.getElementById('galleryPreview');
        container.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative border rounded p-1 bg-light';
                wrapper.style.width = '140px';
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'rounded d-block';
                img.style.width = '100%';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                wrapper.appendChild(img);
                container.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
