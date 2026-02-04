@extends('dashboard.includes.layout')

@section('content')
 <div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">{{ isset($member) ? 'Edit Member' : 'Add Member' }}</div> 
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

                    <form action="{{ isset($member) ? route('members.update', $member->id) : route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($member))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-user"></i> Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $member->name ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-envelope"></i> Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $member->email ?? '') }}" required>
                                </div>
                            </div>
                       @if(!isset($member))
    <div class="col-md-6">
        <div class="form-group">
            <label><i class="fas fa-lock"></i> Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label><i class="fas fa-lock"></i> Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>
@endif

                     <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-phone"></i> Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $member->phone ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-map-marker-alt"></i> Address</label>
                                    <textarea class="form-control" name="address">{{ old('address', $member->address ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-venus-mars"></i> Gender</label>
                                    <select class="form-control" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $member->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $member->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $member->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
    <label><i class="fas fa-user-tag"></i> Role</label>
    <select class="form-control" name="role" required>
        <option value="" disabled {{ old('role', $member->role ?? '') == '' ? 'selected' : '' }}>Select Role</option>
        <option value="Admin" {{ old('role', $member->role ?? '') === 'Admin' ? 'selected' : '' }}>Admin</option>
        <option value="Doctor" {{ old('role', $member->role ?? '') === 'Doctor' ? 'selected' : '' }}>Doctor</option>
        <option value="User" {{ old('role', $member->role ?? '') === 'User' ? 'selected' : '' }}>User</option>
    </select>
</div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-image"></i> Profile Image</label>
                                    <input type="file" class="form-control" name="profile">
                                    @if(isset($member) && $member->profile)
                                        <small class="text-muted">Current: <img src="{{ url('storage/profile/'.$member->profile) }}" width="50"></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-toggle-on"></i> Status</label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', $member->status ?? 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-rounded mt-3">
                            <i class="fa-solid fa-user-plus"></i> {{ isset($member) ? 'Update Member' : '  Member' }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
