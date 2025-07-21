<aside class="sidebar d-flex flex-column">
    {{-- Logo dan Nama Aplikasi --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-header text-decoration-none">
        <i class="fas fa-code logo-icon"></i>
        <span class="logo-text">CodeLearn</span>
    </a>

    {{-- Daftar Menu Navigasi --}}
    <ul class="nav nav-pills flex-column mt-4">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt fa-fw"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.tracks.index') }}"
                class="nav-link {{ request()->routeIs('admin.tracks.index') || request()->routeIs('admin.tracks.create') || request()->routeIs('admin.tracks.edit') ? 'active' : '' }}">
                <i class="fas fa-road fa-fw"></i>
                <span>Manajemen Learning Path</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.materials.all') }}"
                class="nav-link {{ request()->routeIs('admin.materials.*') ||
                request()->routeIs('admin.tracks.materials.*') ||
                request()->routeIs('admin.quizzes.*') ||
                request()->routeIs('admin.questions.*')
                    ? 'active'
                    : '' }}">
                <i class="fas fa-book-open fa-fw"></i>
                <span>Manajemen Modul</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.comments.index') }}"
                class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                <i class="fas fa-message fa-fw"></i>
                <span>Manajemen Komentar</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users fa-fw"></i>
                <span>Manajemen Pengguna</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto">
        {{-- Nanti bisa ditambahkan tombol logout atau profil di sini --}}
    </div>
</aside>
