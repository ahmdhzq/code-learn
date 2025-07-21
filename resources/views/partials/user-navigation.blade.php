{{-- Wrapper untuk Navbar Mengambang --}}
<div class="container navbar-container">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm rounded-pill py-2">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ auth()->check() ? route('learn.index') : '/' }}">
                <div class="d-flex align-items-center justify-content-center bg-white rounded-circle me-2"
                    style="width: 40px; height: 40px;">
                    <i class="fas fa-graduation-cap text-primary"></i>
                </div>
                <span class="fw-bold fs-5 text-white">CodeLearn</span>
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    @auth
                        {{-- ================ MENU PENGGUNA LOGIN ================ --}}
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('learn.index') ? 'active' : '' }}"
                                href="{{ route('learn.index') }}">Practice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('leaderboard') ? 'active' : '' }}"
                                href="{{ route('leaderboard') }}">Compete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        {{-- ================ MENU UNTUK TAMU ================ --}}
                        <li class="nav-item">
                            <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/#tracks">Jalur Belajar</a>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="d-none d-lg-flex align-items-center ms-auto">
                @guest
                    {{-- [PENTING] Tombol untuk Tamu (Belum Login) --}}
                    <a href="{{ route('login') }}" class="btn rounded-pill me-2 btn-sign-in">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn rounded-pill btn-sign-up">Sign Up</a>
                    @endif
                @else
                    {{-- Dropdown untuk Pengguna (Sudah Login) --}}
                    <div class="dropdown">
                        <button class="btn btn-outline-light rounded-pill dropdown-toggle d-flex align-items-center"
                            type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if (Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profil Saya</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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

<div class="offcanvas offcanvas-start text-white w-75" tabindex="-1" id="mobileOffcanvas"
    aria-labelledby="mobileOffcanvasLabel" style="background-color: #317a75;">
    <div class="offcanvas-header border-bottom border-white-50">
        <h5 class="offcanvas-title fw-bold" id="mobileOffcanvasLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        @auth
            {{-- Menu Mobile Pengguna Login --}}
            <ul class="navbar-nav flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2 {{ request()->routeIs('learn.index') ? 'active' : '' }}"
                        href="{{ route('learn.index') }}">Practice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2 {{ request()->routeIs('leaderboard') ? 'active' : '' }}"
                        href="{{ route('leaderboard') }}">Compete</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>
            </ul>
            <hr>
            <div class="mt-auto">
                <h6 class="text-white-50 small text-uppercase">Akun Saya</h6>
                @if (Auth::user()->role === 'admin')
                    <a class="d-block text-white text-decoration-none mb-2" href="{{ route('admin.dashboard') }}">Panel
                        Admin</a>
                @endif
                <a class="d-block text-white text-decoration-none mb-3" href="{{ route('profile.show') }}">Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Log Out</button>
                </form>
            </div>
        @else
            {{-- Menu Mobile untuk Tamu --}}
            <ul class="navbar-nav flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2 {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mb-2" href="/#tracks">Jalur Belajar</a>
                </li>
            </ul>
            <hr>
            <div class="mt-auto">
                <a href="{{ route('login') }}" class="btn btn-light w-100 mb-2">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-light w-100">Sign Up</a>
                @endif
            </div>
        @endauth
    </div>
</div>
