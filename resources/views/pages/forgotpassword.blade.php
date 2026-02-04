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
                <h4>Reset Your Password</h4>
               
                <form action="{{ route('forgot.password.submit') }}" method="POST" class="pt-3">
                  @csrf
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Your Email Address">
                  </div>
                  
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >SEND RESET LINK</button>
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