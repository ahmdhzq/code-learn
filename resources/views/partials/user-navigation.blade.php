<div class="navbar-container fixed-top" style="background-color: #317a75">
    <nav class="container navbar navbar-expand-lg navbar-dark py-3">
        <div class="container-fluid">
            {{-- Logo selalu mengarah ke Halaman Utama --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                <div class="d-flex align-items-center justify-content-center bg-white rounded-circle me-2" style="width: 40px; height: 40px;">
                    <i class="fas fa-graduation-cap" style="color:#317a75"></i>
                </div>
                <span class="fw-bold fs-5 text-white">CodeLearn</span>
            </a>

            {{-- Daftar Menu Utama --}}
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('welcome') ? 'active border-bottom border-light border-2' : 'text-white-50' }}"
                            href="{{ route('welcome') }}">Home</a>
                    </li>
                    @auth
                        {{-- Menu KHUSUS PENGGUNA LOGIN --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('learn.*') ? 'active border-bottom border-light border-2' : 'text-white-50' }}"
                                href="{{ route('learn.index') }}">Practice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('leaderboard') ? 'active border-bottom border-light border-2' : 'text-white-50' }}"
                                href="{{ route('leaderboard') }}">Compete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard', 'materials.history', 'materials.create') ? 'active border-bottom border-light border-2' : 'text-white-50' }}"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        {{-- Menu KHUSUS TAMU --}}
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="/#tracks">Jalur Belajar</a>
                        </li>
                    @endauth
                     {{-- Menu UNTUK SEMUA PENGGUNA --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('team.show') ? 'active border-bottom border-light border-2' : 'text-white-50' }}"
                            href="{{ route('team.show') }}">Tim Kami</a>
                    </li>
                </ul>
            </div>

            {{-- Tombol Aksi di Kanan --}}
            <div class="d-none d-lg-flex align-items-center ms-auto">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill me-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-light rounded-pill">Sign Up</a>
                    @endif
                @else
                    <div class="dropdown">
                        <button class="btn btn-outline-light rounded-pill dropdown-toggle d-flex align-items-center"
                            type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if (Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('materials.history') }}">Riwayat Pengajuan</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileOffcanvas" aria-controls="mobileOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</div>

{{-- Menu Mobile Offcanvas --}}
<div class="offcanvas offcanvas-start text-white w-75" tabindex="-1" id="mobileOffcanvas"
    aria-labelledby="mobileOffcanvasLabel" style="background-color: #317a75;">
    <div class="offcanvas-header border-bottom border-white-50">
        <h5 class="offcanvas-title fw-bold" id="mobileOffcanvasLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        {{-- Logika menu mobile disesuaikan dengan yang di atas --}}
        <ul class="navbar-nav flex-grow-1">
            <li class="nav-item">
                <a class="nav-link fs-5 mb-2 {{ request()->routeIs('welcome') ? 'active' : '' }}"
                    href="{{ route('welcome') }}">Home</a>
            </li>
             @auth
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2 {{ request()->routeIs('learn.*') ? 'active' : '' }}"
                        href="{{ route('learn.index') }}">Practice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2 {{ request()->routeIs('leaderboard') ? 'active' : '' }}"
                        href="{{ route('leaderboard') }}">Compete</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2 {{ request()->routeIs('dashboard','materials.history', 'materials.create') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2" href="/#tracks">Jalur Belajar</a>
                </li>
            @endauth
            <li class="nav-item">
                <a class="nav-link fs-5 mb-2 {{ request()->routeIs('team.show') ? 'active' : '' }}"
                    href="{{ route('team.show') }}">Tim Kami</a>
            </li>
        </ul>
        <hr>
        <div class="mt-auto">
             @guest
                <a href="{{ route('login') }}" class="btn btn-light w-100 mb-2">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-light w-100">Sign Up</a>
                @endif
             @else
                <h6 class="text-white-50 small text-uppercase">Akun Saya</h6>
                @if (Auth::user()->role === 'admin')
                    <a class="d-block text-white text-decoration-none mb-2" href="{{ route('admin.dashboard') }}">Panel Admin</a>
                @endif
                <a class="d-block text-white text-decoration-none mb-2" href="{{ route('materials.history') }}">Riwayat Pengajuan</a>
                <a class="d-block text-white text-decoration-none mb-3" href="{{ route('profile.show') }}">Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Log Out</button>
                </form>
             @endguest
        </div>
    </div>
</div>