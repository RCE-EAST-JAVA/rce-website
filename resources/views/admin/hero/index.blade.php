@extends('layouts.admin')

@section('title', 'Kelola Foto Hero')
@section('page-title', 'Kelola Foto Hero')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="card-title mb-0">Foto Slider Hero</h4>
            <small class="text-muted">Maksimal 5 foto • {{ $heroPhotos->count() }}/5 digunakan</small>
        </div>
        @if($heroPhotos->count() < 5)
            <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Foto
            </a>
        @else
            <button class="btn btn-secondary btn-sm" disabled>
                <i class="bi bi-slash-circle"></i> Batas 5 Foto Tercapai
            </button>
        @endif
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Slot indicator --}}
        <div class="d-flex gap-2 mb-4">
            @for($i = 1; $i <= 5; $i++)
                <div class="rounded d-flex align-items-center justify-content-center fw-bold"
                    style="width: 36px; height: 36px; font-size: 0.8rem;
                    background: {{ $i <= $heroPhotos->count() ? '#198754' : '#dee2e6' }};
                    color: {{ $i <= $heroPhotos->count() ? '#fff' : '#6c757d' }};">
                    {{ $i }}
                </div>
            @endfor
            <span class="text-muted small align-self-center ms-1">slot foto hero</span>
        </div>

        @if($heroPhotos->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-images fs-1 d-block mb-3 opacity-25"></i>
                <p class="mb-1">Belum ada foto hero.</p>
                <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="bi bi-plus-circle"></i> Tambah Foto Pertama
                </a>
            </div>
        @else
            <div class="row g-3">
                @foreach($heroPhotos as $photo)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 border shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset($photo->image) }}"
                                class="card-img-top"
                                style="height: 180px; object-fit: cover;"
                                alt="{{ $photo->caption ?? 'Hero Photo' }}">
                            <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75">
                                <i class="bi bi-sort-numeric-up me-1"></i>Urutan {{ $photo->order }}
                            </span>
                            <span class="position-absolute top-0 end-0 m-2 badge {{ $photo->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $photo->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="card-body py-2 px-3">
                            <p class="card-text small text-muted mb-0">
                                {{ $photo->caption ?? '<span class="fst-italic">Tanpa caption</span>' }}
                            </p>
                        </div>
                        <div class="card-footer d-flex gap-2 py-2">
                            <a href="{{ route('admin.hero.edit', $photo->id) }}" class="btn btn-warning btn-sm flex-fill">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('admin.hero.destroy', $photo->id) }}" method="POST"
                                onsubmit="return confirm('Hapus foto hero ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
