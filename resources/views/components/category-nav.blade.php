<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item dropdown kategori-dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-list-ul me-1"></i> Kategori
        </a>
        <ul class="dropdown-menu dropdown-dark-custom shadow-lg">
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-laptop me-2"></i> Elektronik</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-shirt me-2"></i> Fashion</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-couch me-2"></i> Perabotan</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-primary-light fw-bold text-center" href="#">Lihat Semua</a></li>
        </ul>
    </li>
</ul>

<style>
    /* Paksa dropdown tetap vertikal dan tidak memanjang ke samping */
    .dropdown-dark-custom {
        display: none; /* Default bootstrap */
        min-width: 200px;
        background-color: #1a2b3c !important; /* Warna gelap sesuai gambar kamu */
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 10px 0;
        flex-direction: column !important; /* Mencegah item berjejer ke samping */
    }

    /* Saat dropdown terbuka */
    .dropdown-dark-custom.show {
        display: block !important;
    }

    .dropdown-dark-custom .dropdown-item {
        color: #ecf0f1 !important; /* Teks terang */
        padding: 10px 20px;
        display: block !important; /* Pastikan satu baris penuh */
        width: 100%;
        clear: both;
        transition: all 0.2s;
    }

    .dropdown-dark-custom .dropdown-item:hover {
        background-color: #2c3e50; /* Warna hover sedikit lebih terang */
        color: #ffffff !important;
        padding-left: 25px; /* Efek geser */
    }

    .dropdown-dark-custom .dropdown-divider {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin: 8px 0;
    }

    .text-primary-light {
        color: #5dade2 !important; /* Warna biru muda untuk 'Lihat Semua' agar terbaca di gelap */
    }
</style>
