@extends('layouts.app')

@section('content')

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4" style="margin-top: 80px;">
        <h2 class="fw-bold text-white">Daftar Kelas</h2>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
            <i class="fa-solid fa-plus me-2"></i> Tambah Kelas Baru
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    {{-- ==========================================
       NOTIFIKASI SUKSES (Flash Message)
    ========================================== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-check fa-lg me-2"></i>
                <strong>Berhasil!</strong>
                <span class="ms-2">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 border-0">Judul Kelas</th>
                        <th class="py-3 px-4 border-0">Kategori</th>
                        <th class="py-3 px-4 border-0">Harga</th>
                        <th class="py-3 px-4 border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex align-items-center">
                                @if($course->thumbnail)
                                    {{-- Jika ada gambar upload, pakai itu --}}
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                        class="rounded-3 me-3" width="50" height="50" alt="{{ $course->title }}">
                                @else
                                    {{-- Jika tidak ada, pakai dummy --}}
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}"
                                        class="rounded-3 me-3" width="50" height="50" alt="{{ $course->title }}">
                                @endif
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $course->title }}</h6>
                                    <small class="text-muted">{{ $course->duration }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="px-4">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">
                                {{ $course->category->name }}
                            </span>
                        </td>
                        <td class="px-4">
                            @if($course->price == 0)
                                <span class="fw-bold text-success">Gratis</span>
                            @else
                                <span class="fw-bold">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="px-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- TOMBOL HAPUS (Butuh Form Khusus agar aman) --}}
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?');">
                                    @csrf
                                    @method('DELETE')
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

        {{-- Pagination --}}
        @if($courses->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
