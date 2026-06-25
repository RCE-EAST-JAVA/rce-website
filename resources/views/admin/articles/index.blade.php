@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Daftar Artikel</h4>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Artikel
        </a>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>
                            @if($article->thumbnail)
                                <img src="{{ asset($article->thumbnail) }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white" style="width:50px;height:50px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold">{{ Str::limit($article->title, 45) }}</span>
                            <br><small class="text-muted">{{ $article->slug }}</small>
                        </td>
                        <td><span class="badge bg-info">{{ $article->category }}</span></td>
                        <td>{{ $article->author }}</td>
                        <td>
                            <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'secondary' }}">
                                {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus artikel ini?')">
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
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada artikel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
