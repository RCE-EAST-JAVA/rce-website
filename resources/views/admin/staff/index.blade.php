@extends('layouts.admin')

@section('title', 'Manage People')
@section('page-title', 'Manage People')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">RCE East Java People Directory</h4>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add People
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Category</th>
                        <th>Expertise</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffs as $staff)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $staff->sort_order }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($staff->image)
                                    <img src="{{ asset($staff->image) }}" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                                <strong>{{ $staff->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $staff->role }}</td>
                        <td><span class="badge bg-info">{{ $staff->category }}</span></td>
                        <td>
                            @if($staff->expertise)
                                @foreach(explode(',', $staff->expertise) as $exp)
                                    <span class="badge bg-secondary mb-1">{{ trim($exp) }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($staff->email)
                                <a href="mailto:{{ $staff->email }}" class="text-decoration-none me-2"><i class="bi bi-envelope-fill"></i></a>
                            @endif
                            @if($staff->linkedin)
                                <a href="https://{{ $staff->linkedin }}" target="_blank" class="text-decoration-none text-info"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this person?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No people found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $staffs->links() }}
        </div>
    </div>
</div>
@endsection
