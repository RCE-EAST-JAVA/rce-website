@extends('layouts.admin')

@section('title', 'Manage Partners')
@section('page-title', 'Manage Partners')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Partners & Collaborators</h4>
        @if(auth()->user()->hasPermission('partners', 'create'))
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Partner
        </a>
        @endif
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
                @if(auth()->user()->hasPermission('partners', 'create'))
                <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="bi bi-plus-circle"></i> Add First Partner
                </a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">Logo</th>
                            <th>Partner Name</th>
                            @if(auth()->user()->hasPermission('partners', 'edit') || auth()->user()->hasPermission('partners', 'delete'))
                            <th style="width: 180px;" class="text-end">Actions</th>
                            @endif
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
                            @if(auth()->user()->hasPermission('partners', 'edit') || auth()->user()->hasPermission('partners', 'delete'))
                            <td class="text-end">
                                @if(auth()->user()->hasPermission('partners', 'edit'))
                                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                @endif
                                @if(auth()->user()->hasPermission('partners', 'delete'))
                                <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                onsubmit="return confirm('Delete partner {{ $partner->name }}?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $partners->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
