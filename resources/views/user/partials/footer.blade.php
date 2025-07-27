{{-- Footer --}}
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                {{-- Brand & Description --}}
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

                {{-- Quick Links --}}
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('welcome') }}"
                                class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Beranda
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('learn.index') }}"
                                class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Kursus
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('leaderboard') }}"
                                class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Leaderboard
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Tentang Kami
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Programs --}}
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Programs</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Web Development
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Mobile Development
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Data Science
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                UI/UX Design
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                DevOps
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Support --}}
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Help Center
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                FAQ
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Privacy Policy
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Terms of Service
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light opacity-75 text-decoration-none hover-opacity-100">
                                Syarat & Ketentuan
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Get in Touch</h6>
                    <div class="mb-3">
                        <div class="d-flex align-items-start mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2 mt-1"></i>
                            <small class="text-light opacity-75">
                                Jl. Sudirman No. 123<br>
                                Jakarta Pusat, Indonesia
                            </small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <small class="text-light opacity-75">+62 812-3456-7890</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-primary me-2"></i>
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
                        Made with <i class="fas fa-heart text-danger"></i> in Indonesia
                    </small>
                </div>
            </div>
        </div>
    </footer>