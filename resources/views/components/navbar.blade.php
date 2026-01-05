<nav class="navbar fixed-top navbar-expand-lg bg-body-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <i class="text-white fa-solid fa-bars"></i>
        </button>
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img class="navbar-icon" src="{{ asset('assets/img/LogoTentorSebaya-full.png') }}" alt="">
        </a>

        <h1 class="text-white" style="margin-right: 10px;">|</h1>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <x-category-nav />
            @auth
                <li class="nav-item dropdown text-white" style="margin-right: 50px; list-style: none;">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-user me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-gear me-2"></i> Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('direct-logout').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                            </a>

                            <form id="direct-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth

            <style>
                .btn-custom-bright {
                    background-color: #34495e;
                    border-color: #34495e;
                    color: #ffffff;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }

                .btn-custom-bright:hover {
                    background-color: #46637f;
                    border-color: #46637f;
                    color: #ffffff;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
                }

                .btn-outline-custom-bright {
                    background-color: transparent;
                    border: 2px solid #34495e;
                    color: #ecf0f1;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }

                .btn-outline-custom-bright:hover {
                    background-color: #34495e;
                    border-color: #34495e;
                    color: #ffffff;
                }
            </style>

            @guest
                <div class="d-flex align-items-center gap-2" style="margin-right: 20px">
                    <a href="{{ route('login') }}" class="btn btn-outline-custom-bright px-4 rounded-pill">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-custom-bright px-4 rounded-pill shadow-sm">
                        Daftar
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>
