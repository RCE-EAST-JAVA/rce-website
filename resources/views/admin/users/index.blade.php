@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna & Hak Akses (RBAC)')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="card-title mb-1">Daftar Pengguna & Hak Akses Modular</h4>
                    <p class="text-muted text-sm mb-0">Kelola akun pengguna, kredensial login, dan matriks hak akses CRUD.</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Tambah Pengguna</span>
                </a>
            </div>

            <div class="card-body">
                <!-- Filter & Search -->
                <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3 mb-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama, username, email..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <select name="role" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Semua Role --</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin (Superuser)</option>
                            <option value="staff" {{ request('role') === 'staff' ? 'selected' : '' }}>Staf RCE</option>
                            <option value="dosen" {{ request('role') === 'dosen' ? 'selected' : '' }}>Dosen / Pengajar</option>
                            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User (Anggota)</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">Filter</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama & Username</th>
                                <th>Email</th>
                                <th>Role / Hak Akses</th>
                                <th>Status Bimbingan</th>
                                <th>Tanggal Daftar</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($user->avatar)
                                                <img src="{{ asset($user->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 1rem;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                                <small class="text-muted">@<span>{{ $user->username ?? '-' }}</span></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'admin')
                                            <span class="badge bg-danger"><i class="bi bi-shield-lock-fill me-1"></i> Administrator</span>
                                        @elseif($user->role === 'staff')
                                            <span class="badge bg-info text-dark"><i class="bi bi-person-workspace me-1"></i> Staf RCE</span>
                                        @elseif($user->role === 'dosen')
                                            <span class="badge bg-warning text-dark"><i class="bi bi-mortarboard-fill me-1"></i> Dosen</span>
                                        @else
                                            <span class="badge bg-success"><i class="bi bi-person-fill me-1"></i> Anggota RCE</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->sync_bimbingan)
                                            <span class="badge bg-light-primary text-primary"><i class="bi bi-check-circle-fill me-1"></i> Tersinkron</span>
                                        @else
                                            <span class="badge bg-light text-muted">Non-aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Pengguna & Hak Akses">
                                                <i class="bi bi-pencil-fill"></i> Edit
                                            </a>
                                            @if(auth()->id() !== $user->id)
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Pengguna">
                                                        <i class="bi bi-trash-fill"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="bi bi-people fs-2 d-block mb-2"></i>
                                        Tidak ada data pengguna ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
