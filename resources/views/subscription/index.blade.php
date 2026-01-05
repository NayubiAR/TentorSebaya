@extends('layouts.app')

@section('content')

{{--
  MENGGUNAKAN BACKGROUND GELAP (Seperti Header Detail Kelas)
  AGAR KARTU PUTIH TERLIHAT KONTRAS & EKSKLUSIF
--}}
<div class="subscription-section py-5">
    <div class="container mt-5">

        {{-- Header Section --}}
        <div class="text-center mb-5 text-white">
            <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm">
                <i class="fa-solid fa-crown me-1"></i> MEMBERSHIP PLAN
            </span>
            <h1 class="display-5 fw-bold mb-3">Upgrade Skill, Buka Potensi.</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 600px;">
                Pilih paket yang sesuai dengan kebutuhan belajarmu. Batalkan kapan saja.
            </p>
        </div>

        {{-- Pricing Cards Wrapper --}}
        <div class="row justify-content-center g-4">

            {{-- =================================================
               CARD 1: GRATIS (BASIC)
               Style: Mirip dengan kartu video di Detail Kelas
            ================================================= --}}
            <div class="col-lg-2 col-md-6" style="margin-left: 30px;">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background: #f8f9fa;">
                    <div class="card-body p-5 d-flex flex-column">

                        {{-- Title --}}
                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-muted text-uppercase letter-spacing-1">Basic</h5>
                            <h2 class="fw-bold text-dark my-3">Rp 0</h2>
                            <span class="badge bg-light text-secondary border rounded-pill px-3">Selamanya</span>
                        </div>

                        {{-- Features List --}}
                        <ul class="list-unstyled mb-5 text-muted small ">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fa-solid fa-check text-success mt-1 me-3"></i>
                                <span>Akses Video Gratis (Terbatas)</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start text-black-50" style="opacity: 0.5;">
                                <i class="fa-solid fa-xmark mt-1 me-3"></i>
                                <del>Akses Video Premium</del>
                            </li>
                            <li class="mb-3 d-flex align-items-start text-black-50" style="opacity: 0.5;">
                                <i class="fa-solid fa-xmark mt-1 me-3"></i>
                                <del>Download Source Code</del>
                            </li>
                            <li class="mb-3 d-flex align-items-start text-black-50" style="opacity: 0.5;">
                                <i class="fa-solid fa-xmark mt-1 me-3"></i>
                                <del>Sertifikat Kompetensi</del>
                            </li>
                        </ul>

                        {{-- Button (Disabled) --}}
                        <button class="btn btn-outline-secondary w-100 rounded-pill py-3 fw-bold" disabled>
                            Paket Saat Ini
                        </button>
                    </div>
                </div>
            </div>

            {{-- =================================================
               CARD 2: PREMIUM (HIGHLIGHT)
               Style: Mirip kartu Detail Kelas tapi lebih menonjol
            ================================================= --}}
            <div class="col-lg-4 col-md-6">
                {{-- Border kuning tipis di atas sebagai penanda Premium --}}
                <div class="card-premium border-0 shadow-lg rounded-4 h-100 overflow-hidden position-relative bg-white premium-card-hover">

                    {{-- Badge Pilihan Terbaik --}}
                    <div class="bg-warning text-dark text-center fw-bold py-2 small">
                        <i class="fa-solid fa-star me-1"></i> PILIHAN TERBAIK
                    </div>

                    <div class="card-body p-5 d-flex flex-column">

                        {{-- Title --}}
                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-success text-uppercase letter-spacing-1">Premium Member</h5>
                            <h2 class="display-4 fw-bold text-dark my-3">Rp 99rb</h2>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Bulan / Berlangganan</span>
                        </div>

                        {{-- Features List --}}
                        <ul class="list-unstyled mb-5 text-dark small flex-grow-1">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-3"></i>
                                <span class="fw-semibold">Akses UNLIMITED Semua Video</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-3"></i>
                                <span>Akses Video Premium Exclusive</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-3"></i>
                                <span>Download Source Code Project</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-3"></i>
                                <span>Klaim Sertifikat Digital</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-3"></i>
                                <span>Prioritas Support Mentor</span>
                            </li>
                        </ul>

                        {{-- Button (Active Form) --}}
                        <form action="{{ route('subscription.upgrade') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-sm"
                                onclick="return confirm('Yakin ingin upgrade Premium? (Simulasi)')">
                                <i class="fa-solid fa-crown me-2"></i> Upgrade Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <small class="text-muted" style="font-size: 0.8rem;">
                                <i class="fa-solid fa-shield-halved me-1"></i> Transaksi Aman & Terenkripsi
                            </small>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Menggunakan Background Gelap yang sama dengan Header Detail Kelas
       agar konsisten */
    .subscription-section {
        background-color: #212529; /* bg-dark Bootstrap */
        background-image: linear-gradient(180deg, #212529 0%, #343a40 100%);
        min-height: 100vh;
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    /* Efek Hover Halus pada Kartu Premium */
    .premium-card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .premium-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }

    /* Pastikan Font Check-list lebih enak dibaca */
    .list-unstyled li {
        line-height: 1.6;
    }

    .card-premium{
        max-width: 550px;
        margin: auto;
        position: relative;
    }
</style>
@endsection
