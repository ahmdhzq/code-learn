@extends('layouts.app')

@section('title', 'Admin Panel - CodeLearn')

@section('content')
<div class="admin-layout">
    
    {{-- Memanggil Sidebar --}}
    @include('partials.admin-sidebar')

    {{-- Kontainer utama untuk konten halaman --}}
    <div class="main-content">
        
        {{-- Memanggil Navbar --}}
        @include('partials.admin-navbar')

        {{-- Konten utama setiap halaman admin akan dimuat di sini --}}
        <main class="p-4 p-md-5">
            @yield('page-content')
        </main>

    </div>
</div>
@endsection

{{-- Memuat Chart.js dari CDN dan script kustom --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/admin-mobile.js') }}"></script>
@endpush