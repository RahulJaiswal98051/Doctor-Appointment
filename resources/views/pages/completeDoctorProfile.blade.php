@extends('dashboard.includes.layout')
@section('content')

<div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card">
                  <div class="card-header">Complete Doctor Profile</div> 
                <div class="card-body">
                     
                      {{-- Success Message  --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                      {{-- Error Messages   --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

<form action="{{ route('storeDoctorProfile') }}" method="POST" class="row g-3">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">

    <div class="col-md-6">
        <label for="specialization" class="form-label">Specialization</label>
        <input type="text" name="specialization" id="specialization"
               class="form-control"
               value="{{ old('specialization', $profile->specialization ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="experience" class="form-label">Experience</label>
        <input type="text" name="experience" id="experience"
               class="form-control"
               value="{{ old('experience', $profile->experience ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="degree" class="form-label">Degree</label>
        <input type="text" name="degree" id="degree" class="form-control mb-2"
               placeholder="Enter degree"
               value="{{ old('degree', $profile->degree ?? '') }}" required >
    </div>

    <div class="col-md-6">
        <label for="consultation_fee" class="form-label">Consultation Fee</label>
        <input type="number" name="consultation_fee" id="consultation_fee"
               class="form-control"
               value="{{ old('consultation_fee', $profile->consultation_fee ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Status</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="active" value="1" 
                {{ (old('status', $profile->status ?? 1) == 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="inactive" value="0"
                {{ (old('status', $profile->status ?? -1) == 0) ? 'checked' : '' }}>
            <label class="form-check-label" for="inactive">Inactive</label>
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            {{ isset($profile) ? 'Update Profile' : 'Create Profile' }}
        </button>
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
@endsection
