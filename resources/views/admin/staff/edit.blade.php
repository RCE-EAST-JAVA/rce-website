@extends('layouts.admin')

@section('title', 'Edit People')
@section('page-title', 'Manage People')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit People Profile</h4>
    </div>
    <div class="card-body">
        <form id="edit-staff-form" action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label for="name" class="form-label">Full Name with Title <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', $staff->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="role" class="form-label">Role at RCE East Java <span class="text-danger">*</span></label>
                    <input type="text" id="role" class="form-control @error('role') is-invalid @enderror"
                        name="role" value="{{ old('role', $staff->role) }}" required>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" required>
                        <option value="">-- Select Category --</option>
                        <option value="Researcher" {{ old('category', $staff->category) === 'Researcher' ? 'selected' : '' }}>Researcher</option>
                        <option value="Research Assistant" {{ old('category', $staff->category) === 'Research Assistant' ? 'selected' : '' }}>Research Assistant</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="expertise" class="form-label">Expertise / Skills (separate with comma)</label>
                    <input type="text" id="expertise" class="form-control @error('expertise') is-invalid @enderror"
                        name="expertise" value="{{ old('expertise', $staff->expertise) }}">
                    @error('expertise')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', $staff->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="linkedin" class="form-label">LinkedIn Profile URL</label>
                    <input type="text" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror"
                        name="linkedin" value="{{ old('linkedin', $staff->linkedin) }}" placeholder="https://linkedin.com/in/username">
                    @error('linkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                        name="sort_order" value="{{ old('sort_order', $staff->sort_order) }}" min="0" placeholder="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Lower number appears first. Use 0 for default order.</div>
                </div>

                <div class="col-12 mb-4">
                    <label for="image" class="form-label">Profile Photo (leave blank to keep current)</label>
                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror"
                        name="image" accept="image/*">
                    @if($staff->image)
                        <div class="mt-2">
                            <span class="text-muted d-block mb-1">Current Photo:</span>
                            <img src="{{ asset($staff->image) }}" class="rounded img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-4">
                    <label class="form-label">Description / Bio</label>
                    @error('description')
                        <div class="text-danger small mb-1">{{ $message }}</div>
                    @enderror
                    <div id="description-editor" style="height: 250px;"></div>
                    <input type="hidden" name="description" id="description-input">
                </div>

                <div class="col-12 mt-2">
                    <button type="button" id="update-btn" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-light-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#description-editor', {
        theme: 'snow',
        placeholder: 'Write a bio or description here...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link'],
                ['clean']
            ]
        }
    });

    // Load existing description content
    var existingContent = {!! json_encode(old('description', $staff->description)) !!};
    if (existingContent) {
        quill.clipboard.dangerouslyPasteHTML(existingContent);
    }

    document.getElementById('update-btn').addEventListener('click', function () {
        document.getElementById('description-input').value = quill.root.innerHTML;
        document.getElementById('edit-staff-form').submit();
    });
</script>
@endsection
