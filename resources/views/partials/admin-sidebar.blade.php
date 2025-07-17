<aside class="sidebar d-flex flex-column p-3">
    {{-- Logo dan Nama Aplikasi --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-header text-decoration-none">
        <i class="fas fa-code logo-icon"></i>
        <span class="logo-text">CodeLearn</span>
    </a>
    
    {{-- Daftar Menu Navigasi --}}
    <ul class="nav nav-pills flex-column mt-4">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt fa-fw"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.tracks.index') }}" class="nav-link {{ request()->routeIs('admin.tracks.*') ? 'active' : '' }}">
                <i class="fas fa-road fa-fw"></i>
                <span>Kelola Tracks</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-book-open fa-fw"></i>
                <span>Kelola Materi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-question-circle fa-fw"></i>
                <span>Kelola Kuis</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-users fa-fw"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto">
        {{-- Nanti bisa ditambahkan tombol logout atau profil di sini --}}
    </div>
</aside>
