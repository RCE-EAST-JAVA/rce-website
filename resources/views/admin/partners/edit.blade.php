@extends('layouts.admin')

@section('title', 'Edit Partner')
@section('page-title', 'Edit Partner')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Edit Partner</h4>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back
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

        <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Partner Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $partner->name) }}" placeholder="e.g. Universitas Negeri Surabaya">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Logo</label>

                @if($partner->logo)
                    <div class="mb-2">
                        <p class="small text-muted mb-1">Current logo:</p>
                        <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}"
                            class="rounded border bg-light p-2" style="max-height: 80px; object-fit: contain;">
                    </div>
                @endif

                <input type="file" name="logo" id="logoInput" class="form-control @error('logo') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/svg+xml,image/webp">
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Leave empty to keep current logo. Format: JPG, PNG, SVG, WEBP. Max 2MB.</div>

                <div id="logoPreview" class="mt-3 d-none">
                    <p class="small text-muted mb-1">Preview logo baru:</p>
                    <img id="previewImg" src="#" alt="Preview"
                        class="rounded border bg-light p-2" style="max-height: 80px; object-fit: contain;">
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Changes
                </button>
                <a href="{{ route('admin.partners.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('logoInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('logoPreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
