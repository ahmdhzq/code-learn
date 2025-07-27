@extends('layouts.user')
@section('title', 'Edit Profil')

@section('content')

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="list-group shadow-sm">
                    <a href="#profile-information" 
                       class="list-group-item list-group-item-action d-flex align-items-center py-3 active">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-user text-success"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">Informasi Profil</div>
                            <small class="text-muted">Update profile data</small>
                        </div>
                    </a>
                    <a href="#update-password" 
                       class="list-group-item list-group-item-action d-flex align-items-center py-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-lock text-primary"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">Ubah Password</div>
                            <small class="text-muted">Security settings</small>
                        </div>
                    </a>
                    <a href="#delete-account" 
                       class="list-group-item list-group-item-action d-flex align-items-center py-3">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-trash text-danger"></i>
                        </div>
                        <div>
                            <div class="fw-semibold text-danger">Hapus Akun</div>
                            <small class="text-muted">Permanent deletion</small>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <!-- Profile Information Card -->
                <div id="profile-information" class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-user-edit text-success fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">Informasi Profil</h4>
                                <p class="text-muted mb-0">Update your account's profile information and email address.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password Card -->
                <div id="update-password" class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-shield-alt text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">Update Password</h4>
                                <p class="text-muted mb-0">Ensure your account is using a long, random password to stay secure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div id="delete-account" class="card shadow-sm border-0">
                    <div class="card-header bg-white py-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1 text-danger">Delete Account</h4>
                                <p class="text-muted mb-0">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Stories Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">
                    100k+ <span class="text-success">happy learners!</span>
                </h2>
                <p class="text-muted fs-5">Join thousands of users who have transformed their skills</p>
            </div>
            
            <!-- User Grid -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-4 col-md-2">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" 
                                 class="img-fluid rounded-circle" alt="User">
                        </div>
                        <div class="col-4 col-md-2">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" 
                                 class="img-fluid rounded-circle" alt="User">
                        </div>
                        <div class="col-4 col-md-2">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" 
                                 class="img-fluid rounded-circle" alt="User">
                        </div>
                        <div class="col-4 col-md-2">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face" 
                                 class="img-fluid rounded-circle" alt="User">
                        </div>
                        <div class="col-4 col-md-2">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face" 
                                 class="img-fluid rounded-circle" alt="User">
                        </div>
                        <div class="col-4 col-md-2">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face" 
                                 class="img-fluid rounded-circle" alt="User">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.partials.footer')

    <style>
        .card {
            border-radius: 1rem !important;
        }
        
        .rounded-4 {
            border-radius: 1rem !important;
        }
        
        .list-group-item.active {
            background-color: var(--bs-success) !important;
            border-color: var(--bs-success) !important;
        }
        
        .list-group-item:hover {
            background-color: rgba(var(--bs-success-rgb), 0.1);
        }
        
        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        // Smooth navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endsection