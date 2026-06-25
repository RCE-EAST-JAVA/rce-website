@extends('layouts.portal')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
<div class="row">
    <!-- Card 1: Informasi Profil -->
    <div class="col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Profil</h4>
                <p class="text-muted text-sm">Perbarui informasi profil dan alamat email akun Anda.</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('portal.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <!-- Avatar Preview & Upload -->
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="avatar avatar-xl">
                            @if($user->avatar)
                                <img src="{{ asset($user->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-weight: bold; font-size: 1.8rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="form-label fw-bold">Foto Profil (WebP)</label>
                            <input type="file" id="avatar" name="avatar" class="form-control form-control-sm @error('avatar') is-invalid @enderror" accept="image/*">
                            <span class="text-muted text-xs d-block mt-1">Maksimal ukuran file: 5 MB (Gambar otomatis dikonversi ke WebP)</span>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Card 2: Ubah Password -->
    <div class="col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Password</h4>
                <p class="text-muted text-sm">Pastikan akun Anda menggunakan password acak yang panjang untuk menjaga keamanan.</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" id="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" required autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Card 3: Hapus Akun -->
    <div class="col-12 mb-4">
        <div class="card border border-danger">
            <div class="card-header bg-danger-light">
                <h4 class="card-title text-danger">Hapus Akun</h4>
                <p class="text-muted text-sm mb-0">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
            </div>
            <div class="card-body pt-3">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    Hapus Akun Saya
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Akun -->
<div class="modal fade text-left" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel120">Konfirmasi Hapus Akun</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form method="post" action="{{ route('portal.profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-body">
                    <p class="text-sm">Apakah Anda yakin ingin menghapus akun Anda? Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                    
                    <div class="mb-3">
                        <label for="delete_password" class="form-label sr-only">Password</label>
                        <input type="password" id="delete_password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Password Anda" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger ms-1">
                        Hapus Akun Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
