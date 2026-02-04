
@extends('dashboard.user.layout')
@section('content')
  <header class="hero">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h1>Your Health, Our Priority</h1>
          <p class="lead mb-4">Book appointments with top-rated specialists in your area instantly. Trusted by thousands of patients.</p>
        </div>
      </div>
    </div>
  </header>

 

  <!-- Featured Doctors -->
  <section class="container mt-5 pt-5" id="doctors">
    <div class="text-center">
      <h2 class="section-title">Top Rated Specialists</h2>
      <p class="text-muted">Book an appointment with our most trusted doctors.</p>
    </div>
    
    <div class="row g-4 mt-3">
      @forelse($doctors as $doctor)
      <div class="col-md-4">
        <div class="doctor-card">
          <img src="{{ asset('storage/profile/' . $doctor->user->profile) }}" class="card-img-top" alt="{{ $doctor->user->name }}">
          <div class="doctor-info">
            <h5 class="doctor-name">Dr. {{ $doctor->user->name }}</h5>
            <p class="doctor-specialty">{{ $doctor->specialization }}</p>
            <div class="mb-3 text-warning small">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> (4.8)
            </div>
            <a href="#" class="btn btn-outline-primary w-100 rounded-pill">View Profile</a>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center">
          <p class="text-muted">No doctors found at the moment.</p>
      </div>
      @endforelse
    </div>
  </section>

  <section class="container mt-5 pt-5 pb-5">
    <div class="row align-items-center">
      <div class="col-md-6 order-md-2">
        <img src="{{ asset('storage/profile/doctor-character-background_1270-84.avif') }}" class="img-fluid rounded-3" alt="Illustration" style="max-height: 400px; width: auto; display: block; margin: auto;">
        <div class="text-center text-muted small mt-2"></div>
      </div>
      <div class="col-md-6 order-md-1">
        <h2 class="section-title">Simple Steps to Health</h2>
        <div class="d-flex mb-4">
          <div class="flex-shrink-0">
             <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.2rem;"><i class="fas fa-search"></i></div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h5>Search for a Doctor</h5>
            <p class="text-muted">Enter your location and illness to find the best specialist near you.</p>
          </div>
        </div>
        <div class="d-flex mb-4">
          <div class="flex-shrink-0">
             <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.2rem;"><i class="fas fa-calendar-alt"></i></div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h5>Choose a Schedule</h5>
            <p class="text-muted">Select a date and time that fits your schedule perfectly.</p>
          </div>
        </div>
        <div class="d-flex">
          <div class="flex-shrink-0">
             <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.2rem;"><i class="fas fa-check"></i></div>
          </div>
          <div class="flex-grow-1 ms-3">
            <h5>Book Appointment</h5>
            <p class="text-muted">Confirm your booking immediately and get peace of mind.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Example Slots -->
  <section class="bg-white py-5">
    <div class="container text-center">
        <h2 class="section-title mb-4">Quick Booking Example</h2>
        <div class="card border-0 shadow-sm d-inline-block text-start" style="max-width: 500px; width: 100%;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('storage/profile/photo-1612349317150-e413f6a5b16d.avif') }}" class="rounded-circle me-3" width="60" alt="">
                    <div>
                        <h5 class="mb-0">Dr. Sarah Johnson</h5>
                        <small class="text-muted">Cardiologist</small>
                    </div>
                </div>
                <h6 class="mb-3">Available Slots on Feb 1, 2026:</h6>
                 <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <button class="time-slot active">10:00 AM</button>
                    <button class="time-slot">11:30 AM</button>
                    <button class="time-slot">02:30 PM</button>
                    <button class="time-slot">04:00 PM</button>
                </div>
            </div>
        </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5 class="text-white"><i class="fas fa-heartbeat me-2 text-primary"></i> DoctorPortal</h5>
          <p class="small text-muted">We are committed to providing you with the best medical healthcare services. Your health is our top priority.</p>
          <div class="mt-3">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="col-md-2 mb-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
             <li><a href="#">Home</a></li>
             <li><a href="#">About Us</a></li>
             <li><a href="#">Services</a></li>
             <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-2 mb-4">
          <h5>For Patients</h5>
          <ul class="list-unstyled">
             <li><a href="#">Find a Doctor</a></li>
             <li><a href="#">Book Appointment</a></li>
             <li><a href="#">Health Tips</a></li>
             <li><a href="#">Login</a></li>
          </ul>
        </div>
        <div class="col-md-4 mb-4">
          <h5>Contact Us</h5>
          <ul class="list-unstyled text-muted small">
            <li><i class="fas fa-map-marker-alt me-2"></i> 123 Medical Center Dr, New York, NY</li>
            <li><i class="fas fa-phone me-2"></i> +1 (555) 123-4567</li>
            <li><i class="fas fa-envelope me-2"></i> support@doctorportal.com</li>
          </ul>
        </div>
      </div>
      <hr style="border-color: rgba(255,255,255,0.1);">
      <div class="text-center small text-muted">
        &copy; 2026 DoctorPortal. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
