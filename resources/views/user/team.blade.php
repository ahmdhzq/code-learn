@extends('layouts.user')

@section('title', 'Tim Kami - CodeLearn')

@push('styles')
<style>
    .team-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .team-card {
        background: white;
        border: none;
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.3s ease;
        height: 100%;
    }
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(49, 122, 117, 0.15);
    }
    .team-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e9ecef;
        transition: all 0.3s ease;
    }
    .team-card:hover .team-avatar {
        border-color: #317a75;
        transform: scale(1.05);
    }
    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        background: #f8f9fa;
        color: #6c757d;
        text-decoration: none;
        margin: 0 0.25rem;
        transition: all 0.3s ease;
    }
    .social-links a:hover {
        background: #317a75;
        color: white;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="team-section">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold mb-3">Tim Pengembang Kami</h1>
            <p class="fs-5 text-muted">Orang-orang di balik layar yang membuat CodeLearn menjadi mungkin</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="team-card text-center">
                    <img src={{ asset('assets/images/haziq.jpeg') }} 
                         class="team-avatar mx-auto mb-3" alt="Profile">
                    <h4 class="fw-bold mb-1">Ahmad Haziq Mu'izzaddin Wafiq</h4>
                    <p class="text-muted mb-3">NIM: 230401010151</p>
                    <div class="social-links">
                        <a href="https://linkedin.com/in/ahmdhzq18"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://github.com/ahmdhzq"><i class="fab fa-github"></i></a>
                        <a href="https://instagram.com/ahmd_haziqqq"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="team-card text-center">
                    <img src={{ asset('assets/images/christ.jpeg') }} 
                         class="team-avatar mx-auto mb-3" alt="Profile">
                    <h4 class="fw-bold mb-1">Christ Dwi Marsono</h4>
                    <p class="text-muted mb-3">NIM: 230401010144</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://github.com/Christdm18"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="team-card text-center">
                    <img src={{ asset('assets/images/revi.jpeg') }} 
                         class="team-avatar mx-auto mb-3" alt="Profile">
                    <h4 class="fw-bold mb-1">Revika Hendo Wiyogo</h4>
                    <p class="text-muted mb-3">NIM: 230401010158</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://github.com/Revikahnd"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.partials.footer')
@endsection