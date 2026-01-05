@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center" style="margin-top: 80px;">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-white">Edit Kelas</h2>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="shadow-sm">
                <div class="card-body p-5">

                    {{-- Form mengarah ke route UPDATE --}}
                    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Wajib untuk Update data --}}

                        {{-- 1. Judul --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white">Judul Kelas</label>
                            <input type="text" name="title" class="form-control py-3" value="{{ $course->title }}" required>
                        </div>

                        {{-- Thumbnail (BARU) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white">Ganti Gambar Sampul</label>

                            {{-- Preview Gambar Lama --}}
                            @if($course->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail Lama" class="img-thumbnail rounded-3" style="max-height: 150px;">
                                </div>
                            @endif

                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                        </div>

                        <div class="row">
                            {{-- 2. Kategori --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">Kategori</label>
                                <select name="category_id" class="form-select py-3" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- 3. Tipe Akses (Logika: Jika harga > 0 maka Premium) --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">Tipe Akses</label>
                                <select name="access_type" class="form-select py-3" required>
                                    <option value="free" {{ $course->price == 0 ? 'selected' : '' }}>Gratis (Semua User)</option>
                                    <option value="premium" {{ $course->price > 0 ? 'selected' : '' }}>Premium (Khusus Member)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            {{-- 4. Durasi --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">Durasi</label>
                                <input type="text" name="duration" class="form-control py-3" value="{{ $course->duration }}" required>
                            </div>

                            {{-- 5. ID Youtube --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-white">ID Video Youtube</label>
                                <input type="text" name="video_url" class="form-control py-3" value="{{ $course->video_url }}" required>
                            </div>
                        </div>

                        {{-- 6. Deskripsi --}}
                        <div class="mb-5">
                            <label class="form-label fw-bold text-white">Deskripsi Lengkap</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ $course->description }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning py-3 fw-bold rounded-pill text-white">
                                <i class="fa-solid fa-save me-2"></i> Update Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
