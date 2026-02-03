{{-- Error Messages --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
        <div class="d-flex align-items-start">
            <div class="me-3">
                <i class="fas fa-exclamation-circle fa-lg"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-2">Please fix the following errors:</h6>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Unauthorized Page --}}
<div class="container text-center my-5">
    <div class="card shadow-sm border-0 p-4">
        <div class="mb-3">
            <i class="fas fa-lock fa-3x text-danger"></i>
        </div>
        <h1 class="fw-bold text-danger">Access Denied</h1>
        <p class="text-muted mb-4">
            Sorry, you are not authorized to access this page.<br>
            Please contact the administrator if you believe this is a mistake.
        </p>
     
    </div>
</div>
