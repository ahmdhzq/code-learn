<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" 
                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $user->name) }}" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" 
                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email', $user->email) }}" 
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    <small>
                        Your email address is unverified.
                        <button type="button" class="btn btn-link p-0 text-decoration-none" onclick="document.getElementById('send-verification').submit();">
                            Click here to re-send the verification email.
                        </button>
                    </small>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-2">
                        <small>A new verification link has been sent to your email address.</small>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mt-4">
        <button type="submit" class="btn btn-success btn-lg px-4">
            <i class="fas fa-save me-2"></i>Save Changes
        </button>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success mb-0 py-2 px-3">
                <i class="fas fa-check-circle me-1"></i>
                Profile updated successfully!
            </div>
        @endif
    </div>
</form>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>