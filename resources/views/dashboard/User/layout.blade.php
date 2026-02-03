
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Portal | Find Your Specialist</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #0d6efd;
      --secondary-color: #f8f9fa;
      --accent-color: #00b4d8;
      --text-dark: #2b2b2b;
      --text-light: #6c757d;
      --shadow-sm: 0 5px 15px rgba(0,0,0,0.05);
      --shadow-md: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text-dark);
      background-color: #fafafa;
      padding-top: 76px; /* Space for fixed navbar */
    }

    /* Navbar */
    .navbar {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }
    .navbar-brand {
      font-weight: 700;
      color: var(--primary-color) !important;
      letter-spacing: -0.5px;
    }
    .nav-link {
      color: var(--text-dark);
      font-weight: 500;
      margin: 0 5px;
      transition: 0.3s;
    }
    .nav-link:hover, .nav-link.active {
      color: var(--primary-color) !important;
    }
    .btn-login {
      background: var(--primary-color);
      color: white;
      border-radius: 50px;
      padding: 8px 25px;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn-login:hover {
      background: #0b5ed7;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    /* Hero Section */
    .hero {
      position: relative;
      background: linear-gradient(135deg, rgba(13, 110, 253, 0.9), rgba(0, 180, 216, 0.8)), url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center;
      color: #fff;
      padding: 120px 0 180px; /* Extra bottom padding for search bar overlap */
      text-align: center;
      clip-path: ellipse(150% 100% at 50% 0%);
    }
    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 20px;
      line-height: 1.2;
    }
    .hero p.lead {
      font-size: 1.25rem;
      opacity: 0.9;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Search Container */
    .search-container {
      margin-top: -100px; /* Overlap hero */
      position: relative;
      z-index: 10;
    }
    .search-card {
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: var(--shadow-md);
      border: 1px solid rgba(0,0,0,0.05);
    }
    .form-control, .form-select {
      height: 55px;
      border-radius: 10px;
      border: 2px solid #eee;
      padding-left: 20px;
      font-size: 1rem;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--primary-color);
      box-shadow: none;
    }
    .btn-search {
      height: 55px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 1.1rem;
    }

    /* Section Headings */
    .section-title {
      font-weight: 700;
      margin-bottom: 3rem;
      position: relative;
      display: inline-block;
    }
    .section-title::after {
      content: '';
      display: block;
      width: 60px;
      height: 4px;
      background: var(--primary-color);
      margin: 10px auto 0;
      border-radius: 2px;
    }

    /* Cards */
    .doctor-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      background: #fff;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-sm);
    }
    .doctor-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-md);
    }
    .doctor-card img {
      height: 250px;
      object-fit: cover;
      transition: 0.3s;
    }
    .doctor-card:hover img {
      transform: scale(1.05);
    }
    .doctor-info {
      padding: 20px;
      text-align: center;
    }
    .doctor-name {
      font-weight: 700;
      font-size: 1.25rem;
      margin-bottom: 5px;
    }
    .doctor-specialty {
      color: var(--primary-color);
      font-weight: 500;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Slots */
    .time-slot {
      margin: 5px;
      padding: 10px 20px;
      border: 2px solid var(--primary-color);
      border-radius: 50px;
      color: var(--primary-color);
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      background: transparent;
    }
    .time-slot:hover {
      background-color: var(--primary-color);
      color: #fff;
      box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
    }

    /* Footer */
    footer {
      background: #2b2b2b;
      color: #ddd;
      padding: 60px 0 30px;
      margin-top: 80px;
    }
    footer h5 {
      color: #fff;
      font-weight: 600;
      margin-bottom: 20px;
    }
    footer a {
      color: #aaa;
      text-decoration: none;
      transition: 0.3s;
    }
    footer a:hover {
      color: var(--primary-color);
    }
    .social-icon {
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,0.1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin-right: 10px;
      transition: 0.3s;
    }
    .social-icon:hover {
      background: var(--primary-color);
      color: #fff;
    }

    /* Find Doctor Page Specific Styles */
    /* Find Doctor Page Specific Styles */
    .doctor-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        border-color: transparent;
    }
    .doctor-profile-img {
        width: 100%;
        height: 100%;
        min-height: 220px;
        object-fit: cover;
    }
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .hero-section {
        background: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);
        padding: 4rem 0 3rem;
        margin-bottom: 3rem;
        border-radius: 0 0 30px 30px;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
    }
    
    /* Schedule Area Styles */
    .schedule-column {
        transition: background-color 0.2s;
        border-radius: 8px;
        padding: 10px 5px;
    }
    .schedule-column:hover {
        background-color: #f8f9fa;
    }
    .date-header-text {
        font-size: 1.1rem;
        letter-spacing: -0.5px;
        color: var(--text-dark);
    }
    
    .slot-btn {
        font-size: 0.8rem;
        padding: 6px 12px;
        margin: 4px;
        border-radius: 50px; /* Pill shape */
        border: 1px solid #e9ecef;
        background: #fff;
        color: var(--text-dark);
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.2s ease;
    }
    .slot-btn:hover {
        background: var(--primary-color);
        color: #fff;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }
    .slot-btn:active {
        transform: translateY(0);
    }
    </style>

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="fas fa-heartbeat me-2"></i> DoctorPortal
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link active" href="{{ route("dashboard.user") }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('findDoctors') }}">Find Doctor</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('myBookings', auth()->user()->id) }}">My Bookings</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('profile.update') }}">My Profile</a></li>
          
          <li class="nav-item ms-lg-3">
            <a href="{{route('logout')}}" class="btn btn-login">Signout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')