@extends('layouts.admin')

@section('title', 'Tambah Pengguna & Hak Akses')
@section('page-title', 'Tambah Pengguna Baru & Pengaturan RBAC')

@section('content')
<div class="row">
    <div class="col-12 col-xl-10">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="bi bi-person-badge me-2 text-primary"></i> Informasional Akun Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label font-bold">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Contoh: Dr. Budi Santoso, M.T.">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label font-bold">Username</label>
                            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required placeholder="username (tanpa spasi)">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label font-bold">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="email@rce-eastjava.org">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label font-bold">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="role" class="form-label font-bold">Preset Role / Hak Akses Utama</label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required onchange="applyPresetRole(this.value)">
                                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User / Anggota RCE (Default Member)</option>
                                <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staf RCE (Akses Kelola Konten CMS)</option>
                                <option value="dosen" {{ old('role') === 'dosen' ? 'selected' : '' }}>Dosen / Pengajar (Akses Layanan Bimbingan & Artikel)</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator (Superuser - Akses Penuh)</option>
                                <option value="custom" {{ old('role') === 'custom' ? 'selected' : '' }}>Custom Permission Matrix</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Toggle Switch Layanan Bimbingan -->
                    <div class="p-3 bg-light rounded-3 border mt-4">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" id="sync_bimbingan" name="sync_bimbingan" value="1" {{ old('sync_bimbingan', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label font-bold text-dark" for="sync_bimbingan">
                                <i class="bi bi-mortarboard-fill text-warning me-1"></i> Daftarkan & Sinkronkan ke Sistem Layanan Bimbingan (bimbingan.rce-eastjava.org)
                            </label>
                            <small class="text-muted d-block mt-1">Apabila diaktifkan, akun pengguna ini dapat langsung digunakan untuk otentikasi login di Portal Bimbingan.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Matriks Hak Akses Modular (CRUD Checklist) -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h4 class="card-title mb-1"><i class="bi bi-shield-check me-2 text-success"></i> Matriks Hak Akses Modular (CRUD Checklist)</h4>
                        <p class="text-muted text-sm mb-0">Centang atau hilangkan centang untuk menyesuaikan hak akses per modul fitur secara spesifik.</p>
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary" onclick="checkAll(true)">Centang Semua</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="checkAll(false)">Bersihkan Semua</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 35%;">Modul / Fitur Sistem</th>
                                    <th class="text-center" style="width: 15%;">👁️ Lihat (View)</th>
                                    <th class="text-center" style="width: 15%;">➕ Tambah (Create)</th>
                                    <th class="text-center" style="width: 15%;">✏️ Ubah (Edit)</th>
                                    <th class="text-center" style="width: 15%;">🗑️ Hapus (Delete)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $key => $label)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $label }}</div>
                                            <small class="text-muted">Code: <code>{{ $key }}</code></small>
                                        </td>
                                        
                                        @if($key === 'bimbingan')
                                            <td colspan="4" class="text-center bg-light">
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input perm-cb perm-{{ $key }}-view" type="checkbox" name="permissions[{{ $key }}][view]" value="1" id="perm_{{ $key }}_view">
                                                    <label class="form-check-label font-bold text-dark" for="perm_{{ $key }}_view">Izinkan Akses Direct Portal Bimbingan</label>
                                                </div>
                                            </td>
                                        @else
                                            @foreach(['view', 'create', 'edit', 'delete'] as $action)
                                                <td class="text-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input perm-cb perm-{{ $key }}-{{ $action }}" type="checkbox" name="permissions[{{ $key }}][{{ $action }}]" value="1" id="perm_{{ $key }}_{{ $action }}">
                                                    </div>
                                                </td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mb-5">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Pengguna & Hak Akses</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    function checkAll(status) {
        document.querySelectorAll('.perm-cb').forEach(cb => cb.checked = status);
        document.getElementById('role').value = 'custom';
    }

    function applyPresetRole(role) {
        checkAll(false);
        if (role === 'admin') {
            document.querySelectorAll('.perm-cb').forEach(cb => cb.checked = true);
        } else if (role === 'staff') {
            const staffModules = ['projects', 'articles', 'staff', 'partners', 'hero'];
            staffModules.forEach(m => {
                ['view', 'create', 'edit', 'delete'].forEach(a => {
                    const el = document.getElementById(`perm_${m}_${a}`);
                    if (el) el.checked = true;
                });
            });
        } else if (role === 'dosen') {
            ['view', 'create', 'edit'].forEach(a => {
                const el = document.getElementById(`perm_articles_${a}`);
                if (el) el.checked = true;
            });
            const bim = document.getElementById('perm_bimbingan_view');
            if (bim) bim.checked = true;
            document.getElementById('sync_bimbingan').checked = true;
        } else if (role === 'user') {
            // Basic member has portal & webmail access without CMS write
        }
    }

    // Initialize preset on page load
    document.addEventListener('DOMContentLoaded', function() {
        applyPresetRole(document.getElementById('role').value);
    });
</script>
@endsection
