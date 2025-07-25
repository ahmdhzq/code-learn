<div class="alert alert-danger border-0">
    <h5 class="alert-heading fw-bold">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Delete Account
    </h5>
    <p class="mb-3">
        Once your account is deleted, all of its resources and data will be permanently deleted. 
        Before deleting your account, please download any data or information that you wish to retain.
    </p>
    
    <button type="button" 
            class="btn btn-danger" 
            data-bs-toggle="modal" 
            data-bs-target="#deleteAccountModal">
        <i class="fas fa-trash me-2"></i>Delete Account
    </button>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-danger" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Confirm Account Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> This action cannot be undone. All your data will be permanently deleted.
                    </div>
                    
                    <p class="text-muted mb-3">
                        Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" 
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Enter your password">
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
        deleteModal.show();
    });
</script>
@endif