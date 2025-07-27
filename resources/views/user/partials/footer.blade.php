<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Brand & Deskripsi --}}
                <div class="col-lg-4 col-md-6">
                    <div class="mb-4">
                        <h4 class="fw-bold text-primary mb-3">
                            <i class="fas fa-code me-2"></i>CodeLearn
                        </h4>
                        <p class="text-light opacity-75 mb-4">
                            Platform pembelajaran programming terbaik di Indonesia. Bergabunglah dengan ribuan developer
                            untuk mengembangkan skill dan karir Anda.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-light opacity-75 fs-5 hover-opacity-100">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="text-light opacity-75 fs-5 hover-opacity-100">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-light opacity-75 fs-5 hover-opacity-100">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-light opacity-75 fs-5 hover-opacity-100">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-light opacity-75 fs-5 hover-opacity-100">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

            {{-- Quick Links (Disesuaikan) --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3">Navigasi</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('welcome') }}" class="text-light opacity-75 text-decoration-none hover-opacity-100">Beranda</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('learn.index') }}" class="text-light opacity-75 text-decoration-none hover-opacity-100">Practice</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('leaderboard') }}" class="text-light opacity-75 text-decoration-none hover-opacity-100">Leaderboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('team.show') }}" class="text-light opacity-75 text-decoration-none hover-opacity-100">Tim Kami</a>
                    </li>
                </ul>
            </div>

            {{-- Support (Disederhanakan) --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Support</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">Pusat Bantuan</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">Kebijakan Privasi</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                <div class="mb-3">
                    <div class="d-flex align-items-start mb-2">
                        <i class="fas fa-map-marker-alt me-3 mt-1" style="color: #317a75"></i>
                        <small class="text-light opacity-75">Jl. Merdeka No. 45<br>Jakarta Pusat, Indonesia</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-envelope me-3" style="color: #317a75"></i>
                        <small class="text-light opacity-75">hello@codelearn.id</small>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 opacity-25">

        {{-- Copyright --}}
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <small class="text-light opacity-75">
                    © {{ date('Y') }} CodeLearn. All rights reserved.
                </small>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <small class="text-light opacity-75">
                    Dibuat dengan <i class="fas fa-heart text-danger"></i> oleh Tim CodeLearn
                </small>
            </div>
        </div>
    </div>
</footer>