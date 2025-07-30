{{-- ====================================================== --}}
{{-- Kelompok Code Learn --}}
{{-- Anggota: --}}
{{-- 1. Ahmad Haziq Mu'izzaddin Wafiq (230401010151) --}}
{{-- 2. Christ Dwi Marsono (230401010144) --}}
{{-- 3. Revika Hendo Wiyogo (230401010158) --}}
{{-- ====================================================== --}}

@extends('layouts.user')

@section('title', 'Selamat Datang di CodeLearn')

@section('content')
    {{-- Hero Section --}}
    <div class="bg-white position-relative overflow-hidden">
        <div class="container py-5">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 pe-lg-5">admin/tracks/1/materials
                    <div class="mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-white px-3 py-2 rounded-pill mb-3">
                            <i class="fas fa-star me-2"></i>Platform #1 untuk Belajar Coding
                        </span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4 lh-1">
                        Upgrade <span class="text-primary">your skills</span><br>
                        from the comfort<br>
                        of home.
                    </h1>
                    <p class="fs-5 text-muted mb-5 pe-lg-4">
                        Jelajahi berbagai jalur belajar terstruktur yang dirancang untuk membawa Anda dari pemula menjadi
                        seorang profesional dalam dunia programming.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        @auth
                            <a href="{{ route('learn.index') }}"
                                class="btn btn-primary btn-lg px-4 py-3 rounded-pill fw-semibold">
                                <i class="fas fa-play me-2"></i>Mulai Belajar
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill fw-semibold">
                                <i class="fas fa-play me-2"></i>Mulai Belajar
                            </a>
                            <a href="{{ route('register') }}"
                                class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill fw-semibold">
                                <i class="fas fa-user-plus me-2"></i>Daftar Gratis
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="bg-light rounded-4 p-4 shadow-lg">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Learning from home" class="img-fluid rounded-3 w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Build Bright Careers Section --}}
    <div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);" id="tracks">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-3">Build Bright <span class="text-primary">Careers</span></h2>
                    <p class="text-muted fs-5">Pilih jalur karir yang sesuai dengan minat dan tujuan Anda</p>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-lg-end">
                    @auth
                        <a href="{{ route('learn.index') }}" class="btn btn-primary rounded-pill px-4">
                            Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">
                            Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @endauth
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
                @forelse ($tracks->take(4) as $index => $track)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden hover-lift">

                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="card-title fw-bold mb-3">{{ $track->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1 mb-4">
                                    {{ Str::limit($track->description, 100) }}</p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted small">
                                            <i class="fas fa-book-open me-1"></i>{{ $track->materials_count }} Materi
                                        </span>
                                        <span class="text-muted small">
                                            <i class="fas fa-clock me-1"></i>{{ rand(4, 12) }} Minggu
                                        </span>
                                    </div>

                                    @auth
                                        <a href="{{ route('learn.track.show', $track) }}"
                                            class="btn btn-primary w-100 rounded-pill fw-semibold">
                                            Mulai Belajar
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-pill fw-semibold">
                                            Mulai Belajar
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-book-open fs-1 mb-3 d-block"></i>
                            <p>Belum ada jalur belajar yang tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Educate for Success Section --}}
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="position-relative">
                        <div class="bg-light rounded-4 p-4">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Success in learning" class="img-fluid rounded-3 w-100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="display-5 fw-bold mb-4">Educate for <span class="text-primary">Success</span></h2>
                    <p class="text-muted fs-5 mb-5">
                        Dengan metode pembelajaran yang terbukti efektif dan mentor berpengalaman, kami memastikan setiap
                        siswa mencapai kesuksesan dalam karir programming mereka.
                    </p>

                    <div class="row g-4">
                        <div class="col-6">
                            <div class="text-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-trophy text-white fs-4"></i>
                                </div>
                                <h5 class="fw-bold">Expert Mentors</h5>
                                <p class="text-muted small">Belajar langsung dari para ahli industri</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-certificate text-success fs-4"></i>
                                </div>
                                <h5 class="fw-bold">Certification</h5>
                                <p class="text-muted small">Dapatkan sertifikat yang diakui industri</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-rocket text-warning fs-4"></i>
                                </div>
                                <h5 class="fw-bold">Career Support</h5>
                                <p class="text-muted small">Bantuan penempatan kerja setelah lulus</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-users text-info fs-4"></i>
                                </div>
                                <h5 class="fw-bold">Community</h5>
                                <p class="text-muted small">Bergabung dengan komunitas developer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- How It Works Section --}}
    <div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);" id="how-it-works">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">How It's <span class="text-primary">Work?</span></h2>
                <p class="text-muted fs-5 col-lg-6 mx-auto">
                    Proses pembelajaran yang simple dan efektif dalam 3 langkah mudah
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="bg-white rounded-4 p-4 mb-4 shadow-sm">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                alt="Find your Course" class="img-fluid rounded-3 mb-3"
                                style="height: 200px; object-fit: cover; width: 100%;">
                        </div>
                        <h5 class="fw-bold mb-3">Find your Course</h5>
                        <p class="text-muted">Pilih jalur belajar yang sesuai dengan minat dan tujuan karir Anda</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="bg-white rounded-4 p-4 mb-4 shadow-sm">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                alt="Book & Pay" class="img-fluid rounded-3 mb-3"
                                style="height: 200px; object-fit: cover; width: 100%;">
                        </div>
                        <h5 class="fw-bold mb-3">Book & Pay</h5>
                        <p class="text-muted">Daftar dan lakukan pembayaran dengan sistem yang aman dan mudah</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="bg-white rounded-4 p-4 mb-4 shadow-sm">
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                alt="Get Certificate" class="img-fluid rounded-3 mb-3"
                                style="height: 200px; object-fit: cover; width: 100%;">
                        </div>
                        <h5 class="fw-bold mb-3">Get Certificate</h5>
                        <p class="text-muted">Selesaikan kursus dan dapatkan sertifikat yang diakui industri</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Happy Learners Section --}}
    <div class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3"><span class="text-primary">1000+</span> happy learner!</h2>
                <p class="text-muted fs-5 col-lg-6 mx-auto mb-4">
                    Bergabunglah dengan ribuan siswa yang telah berhasil mengembangkan karir mereka bersama CodeLearn
                </p>
                <a href="{{ route('leaderboard') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                    Join Community
                </a>
            </div>

            {{-- Testimonials Section --}}
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="row g-4">
                        {{-- Main testimonial --}}
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                            alt="Ahmad Susanto" class="rounded-circle me-3"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="fw-bold mb-1">Ahmad Susanto</h6>
                                            <small class="text-muted">Full Stack Developer at Tech Corp</small>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-3">
                                        "CodeLearn memberikan pengalaman belajar yang luar biasa dengan mentor yang
                                        berpengalaman
                                        dan kurikulum yang selalu update dengan teknologi terbaru. Highly recommended!"
                                    </p>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Secondary testimonial --}}
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                            alt="Sari Dewi" class="rounded-circle me-3"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="fw-bold mb-1">Sari Dewi</h6>
                                            <small class="text-muted">Mobile Developer at StartupXYZ</small>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-3">
                                        "Materi yang disajikan sangat praktis dan mudah dipahami. Dalam 6 bulan saya
                                        berhasil
                                        mendapatkan pekerjaan sebagai mobile developer. Terima kasih CodeLearn!"
                                    </p>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Student avatars grid --}}
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row g-3 justify-content-center">
                        <div class="col-4 col-md-2">
                            <div class="text-center">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                    alt="Student" class="rounded-circle shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <h6 class="fw-bold small mt-2 mb-1">Budi P.</h6>
                                <p class="text-muted" style="font-size: 0.75rem;">Data Scientist</p>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="text-center">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                    alt="Student" class="rounded-circle shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <h6 class="fw-bold small mt-2 mb-1">Rina K.</h6>
                                <p class="text-muted" style="font-size: 0.75rem;">UI/UX Designer</p>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="text-center">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                    alt="Student" class="rounded-circle shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <h6 class="fw-bold small mt-2 mb-1">Doni R.</h6>
                                <p class="text-muted" style="font-size: 0.75rem;">DevOps Engineer</p>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="text-center">
                                <img src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                    alt="Student" class="rounded-circle shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <h6 class="fw-bold small mt-2 mb-1">Maya L.</h6>
                                <p class="text-muted" style="font-size: 0.75rem;">Full Stack Dev</p>
                            </div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="text-center">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                    alt="Student" class="rounded-circle shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <h6 class="fw-bold small mt-2 mb-1">Reza M.</h6>
                                <p class="text-muted" style="font-size: 0.75rem;">Backend Dev</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Newsletter Section --}}
    <div class="py-5" style="background: linear-gradient(135deg, #317a75 0%, #2a6b66 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="text-white">
                        <h3 class="fw-bold mb-3">Stay Updated With New Courses & Offers</h3>
                        <p class="mb-0 opacity-75">
                            Dapatkan notifikasi untuk course terbaru, promo menarik, dan tips programming langsung ke email
                            Anda.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-8">
                            <input type="email" class="form-control form-control-lg rounded-pill"
                                placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-light btn-lg w-100 rounded-pill fw-semibold">
                                Subscribe
                            </button>
                        </div>
                    </div>
                    <small class="text-white opacity-75 d-block mt-2">
                        <i class="fas fa-lock me-1"></i>Email Anda aman bersama kami
                    </small>
                </div>
            </div>
        </div>
    </div>

    @include('user.partials.footer')

@endsection
