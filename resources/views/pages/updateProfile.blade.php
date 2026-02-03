@php
    $layout = auth()->user()->role === 'User' ? 'dashboard.User.layout' : 'dashboard.includes.layout';
@endphp
@extends($layout)
@section('content')
 <div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">Update Profile</div> 
                <div class="card-body">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                            <span>{{ session('success') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-start" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update.store', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-user"></i> Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-envelope"></i> Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required readonly>
                                </div>
                            </div>
     

                     <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-phone"></i> Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-map-marker-alt"></i> Address</label>
                                    <textarea class="form-control" name="address">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-venus-mars"></i> Gender</label>
                                    <select class="form-control" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', auth()->user()->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', auth()->user()->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', auth()->user()->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                           

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-image"></i> Profile Image</label>
                                    <input type="file" class="form-control" name="profile">
                                    @if(isset(auth()->user()->profile))
                                        <small class="text-muted">Current: <img src="{{ url('storage/profile/'.auth()->user()->profile) }}" width="50"></small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-toggle-on"></i> Status</label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', auth()->user()->status ?? 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-rounded mt-3">
                            <i class="fa-solid fa-user-plus"></i> Update Profile
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
