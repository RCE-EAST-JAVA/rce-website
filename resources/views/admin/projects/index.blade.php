@extends('layouts.admin')

@section('title', 'Kelola Proyek')
@section('page-title', 'Kelola Proyek')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Daftar Proyek Berkelanjutan</h4>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Proyek
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>SDGs</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($project->display_image)
                                    <img src="{{ asset($project->display_image) }}" class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <span>{{ Str::limit($project->title, 40) }}</span>
                                    @if($project->images->count() > 0)
                                        <small class="d-block text-muted">{{ $project->images->count() }} foto galeri</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info">{{ $project->category }}</span></td>
                        <td>
                            <span class="badge bg-{{ $project->status === 'Aktif' ? 'success' : 'secondary' }}">
                                {{ $project->status }}
                            </span>
                        </td>
                        <td>{{ $project->author }}</td>
                        <td>
                            <div>{{ $project->date }}</div>
                            @if($project->published_at)
                                <small class="text-muted">Publikasi: {{ $project->published_at->format('d M Y') }}</small>
                            @endif
                        </td>
                        <td>{{ $project->sdgs }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
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
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada data proyek.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
