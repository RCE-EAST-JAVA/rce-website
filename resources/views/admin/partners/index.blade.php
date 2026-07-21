@extends('layouts.admin')

@section('title', 'Manage Partners')
@section('page-title', 'Manage Partners')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Partners & Collaborators</h4>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Partner
        </a>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($partners->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-building fs-1 d-block mb-3 opacity-25"></i>
                <p class="mb-1">No partners yet.</p>
                <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="bi bi-plus-circle"></i> Add First Partner
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">Logo</th>
                            <th>Partner Name</th>
                            <th style="width: 180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr>
                            <td>
                                @if($partner->logo)
                                    <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}"
                                        style="width: 48px; height: 48px; object-fit: contain;"
                                        class="rounded border bg-light p-1">
                                @else
                                    <div class="rounded border bg-light d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i class="bi bi-building text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $partner->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                onsubmit="return confirm('Delete partner {{ $partner->name }}?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $partners->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
