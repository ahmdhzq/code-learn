<nav class="admin-navbar">
    <div class="d-flex justify-content-between align-items-center w-100">
        {{-- Mobile menu toggle akan ditambahkan via JavaScript --}}
        
        {{-- Judul Halaman Dinamis --}}
        <h4 class="fw-bold mb-0">@yield('page-title', 'Dashboard')</h4>

        {{-- Menu di sisi kanan navbar --}}
        <div class="d-flex align-items-center">
            
            {{-- User dropdown --}}
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-2 fs-5"></i>
                    {{-- Ganti dengan nama admin yang login --}}
                    {{ auth()->user()->name ?? 'Admin' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user me-2"></i>
                            Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2"></i>
                            Pengaturan
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>