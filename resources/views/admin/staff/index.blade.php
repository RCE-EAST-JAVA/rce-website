@extends('layouts.admin')

@section('title', 'Kelola Staf')
@section('page-title', 'Kelola Staf')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Direktori Anggota & Staf RCE East Java</h4>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Staf
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Peran / Jabatan</th>
                        <th>Afiliasi</th>
                        <th>Keahlian</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffs as $staff)
                    <tr>
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
                        <td>{{ $staff->affiliation }}</td>
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
                                <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus staf ini?')">
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
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data staf.</td>
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
