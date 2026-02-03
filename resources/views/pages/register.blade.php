@include('dashboard.includes.header')
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
               
                  @if ($errors->any())
                  <div class="alert alert-danger">
                  <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                  </div>
                  @endif
                  @if(session('error'))
                  <div class="alert alert-danger">
                  {{ session('error') }}
                  </div>
                  @endif
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" action="{{ route('registerSubmit') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Username" name="name" value="{{ old('name') }}" required>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password" required>
                     </div>
                    <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password_confirmation" placeholder="Confirm Password"name="password_confirmation" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="phone" placeholder="Phone" name="phone" value="{{ old('phone') }}" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="address" placeholder="Address" name="address" value="{{ old('address') }}" required>
                  </div>
                  <div class="form-group">
                    <select class="form-select form-select-lg" id="gender" name="gender" value="{{ old('gender') }}" required>
                      <option >Male</option>
                      <option>Female</option>
                      <option>Other</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="file" class="form-control form-control-lg" id="profile" placeholder="Profile" name="profile" value="{{ old('profile') }}" required>
                  </div>

                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="terms" checked required> I agree to all Terms & Conditions </label>
                    </div>
                  </div>
                  <div class="mt-3 d-grid gap-2" >
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('dashboard.includes.footer')