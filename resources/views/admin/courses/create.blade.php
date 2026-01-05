@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center" style="margin-top: 80px;">
        <div class="col-lg-8">

            {{-- Header & Tombol Kembali --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-white">Tambah Kelas Baru</h2>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class=" border-0 shadow-sm rounded-4">
                <div class="card-body p-5">

                    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- 1. Judul Kelas --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white">Judul Kelas</label>
                            <input type="text" name="title" class="form-control py-3" placeholder="Contoh: Belajar Laravel Dasar" required>
                        </div>

                        {{-- 1.5. Thumbnail (BARU) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white">Gambar Sampul (Thumbnail)</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB.</div>
                        </div>

                        <div class="row">
                            {{-- 2. Kategori --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">Kategori</label>
                                <select name="category_id" class="form-select py-3" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- 3. Tipe Akses (PENGGANTI HARGA) --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">Tipe Akses</label>
                                <select name="access_type" class="form-select py-3" required>
                                    <option value="free">Gratis (Semua User)</option>
                                    <option value="premium">Premium (Khusus Member)</option>
                                </select>
                                <div class="form-text text-white small">
                                    <i class="fa-solid fa-circle-info me-1"></i>
                                    Jika 'Premium', video akan digembok untuk user gratis.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- 4. Durasi --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">Durasi</label>
                                <input type="text" name="duration" class="form-control py-3" placeholder="Contoh: 1 Jam 30 Menit" required>
                            </div>

                            {{-- 5. ID Video Youtube --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">ID Video Youtube</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">youtube.com/</span>
                                    <input type="text" name="video_url" class="form-control py-3" placeholder="dQw4w9WgXcQ" required>
                                </div>
                                <div class="form-text">Hanya ID-nya saja (bagian akhir link Youtube).</div>
                            </div>
                        </div>

                        {{-- 6. Deskripsi --}}
                        <div class="mb-5">
                            <label class="form-label fw-bold text-white">Deskripsi Lengkap</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Jelaskan apa yang akan dipelajari di kelas ini..." required></textarea>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3 fw-bold rounded-pill">
                                <i class="fa-solid fa-save me-2"></i> Simpan Kelas Baru
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
