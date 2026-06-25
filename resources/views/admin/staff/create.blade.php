@extends('layouts.admin')

@section('title', 'Tambah Staf')
@section('page-title', 'Tambah Staf Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Input Profil Staf</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label for="name" class="form-label">Nama Lengkap beserta Gelar <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Contoh: Dr. H. Ahmad Yani, M.T." required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
                    <label for="role" class="form-label">Jabatan di RCE East Java <span class="text-danger">*</span></label>
                    <input type="text" id="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" placeholder="Contoh: Koordinator Bidang Energi" required>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 col-12 mb-3">
                    <label for="affiliation" class="form-label">Afiliasi Universitas / Lembaga <span class="text-danger">*</span></label>
                    <input type="text" id="affiliation" class="form-control @error('affiliation') is-invalid @enderror" name="affiliation" value="{{ old('affiliation') }}" placeholder="Contoh: Institut Teknologi Sepuluh Nopember" required>
                    @error('affiliation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="expertise" class="form-label">Kepakaran / Keahlian (Pisahkan dengan koma)</label>
                    <input type="text" id="expertise" class="form-control @error('expertise') is-invalid @enderror" name="expertise" value="{{ old('expertise') }}" placeholder="Contoh: Eco-design, Energi Terbarukan">
                    @error('expertise')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="email" class="form-label">Email Staf</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Contoh: nama@rce-eastjava.org">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="linkedin" class="form-label">LinkedIn (Username/URL)</label>
                    <input type="text" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ old('linkedin') }}" placeholder="Contoh: linkedin.com/in/username">
                    @error('linkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-4">
                    <label for="image" class="form-label">Foto Profil</label>
                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.staff.index') }}" class="btn btn-light-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
