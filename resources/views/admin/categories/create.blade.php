@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center" style="margin-top: 80px;">
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-white">Tambah Kategori</h3>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill">Kembali</a>
            </div>
            <div class="border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white">Nama Kategori</label>
                            <input type="text" name="name" class="form-control py-2" placeholder="Contoh: Mobile Development" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
