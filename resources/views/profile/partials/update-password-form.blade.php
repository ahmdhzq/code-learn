<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="row g-3">
        <div class="col-12">
            <label for="current_password" class="form-label fw-semibold">Current Password</label>
            <input type="password" 
                   class="form-control form-control-lg @error('current_password', 'updatePassword') is-invalid @enderror" 
                   id="current_password" 
                   name="current_password" 
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="password" class="form-label fw-semibold">New Password</label>
            <input type="password" 
                   class="form-control form-control-lg @error('password', 'updatePassword') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <input type="password" 
                   class="form-control form-control-lg @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mt-4">
        <button type="submit" class="btn btn-primary btn-lg px-4">
            <i class="fas fa-shield-alt me-2"></i>Update Password
        </button>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mb-0 py-2 px-3">
                <i class="fas fa-check-circle me-1"></i>
                Password updated successfully!
            </div>
        @endif
    </div>
</form>