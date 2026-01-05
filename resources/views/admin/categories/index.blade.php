@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4" style="margin-top: 80px;">
        <h2 class="fw-bold text-white">Kelola Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
            <i class="fa-solid fa-plus me-2"></i> Tambah Kategori
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 border-0">Nama Kategori</th>
                        <th class="py-3 px-4 border-0">Slug</th>
                        <th class="py-3 px-4 border-0">Jumlah Kelas</th>
                        <th class="py-3 px-4 border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td class="px-4 fw-bold">{{ $cat->name }}</td>
                        <td class="px-4 text-muted">{{ $cat->slug }}</td>
                        <td class="px-4">
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">
                                {{ $cat->courses_count }} Kelas
                            </span>
                        </td>
                        <td class="px-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
