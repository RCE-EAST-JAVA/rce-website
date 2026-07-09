@extends('layouts.admin')

@section('title', 'Add Partner')
@section('page-title', 'Add Partner')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Add New Partner</h4>
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

        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Partner Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="e.g. Universitas Negeri Surabaya">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Logo <span class="text-muted fw-normal">(optional)</span></label>
                <input type="file" name="logo" id="logoInput" class="form-control @error('logo') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/svg+xml,image/webp">
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Format: JPG, PNG, SVG, WEBP. Max 2MB.</div>

                <div id="logoPreview" class="mt-3 d-none">
                    <p class="small text-muted mb-1">Preview:</p>
                    <img id="previewImg" src="#" alt="Preview"
                        class="rounded border bg-light p-2" style="max-height: 100px; object-fit: contain;">
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Partner
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
