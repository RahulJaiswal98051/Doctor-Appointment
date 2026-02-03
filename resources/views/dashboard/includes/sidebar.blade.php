
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="{{ route('profile.update') }}" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ url('storage/profile/' . auth()->user()->profile) }}" alt="profile" />
                  <span class="login-status online"></span>

                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                  <span class="text-secondary text-small">{{ auth()->user()->role }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
           
            @if(auth()->user()->role === 'Admin')
             <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.admin') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="{{ route('members.index') }}">
                <span class="menu-title">Users</span>
                <i class="fa-solid fa-users menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('appointments.index') }}">
                <span class="menu-title">Appointments</span>
                <i class="fa-solid fa-calendar-check menu-icon"></i>
              </a>
            @elseif(auth()->user()->role === 'Doctor')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.doctor') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('show.appointments.doctor', auth()->user()->id) }}">
                <span class="menu-title"> Your Appointments</span>
                <i class="fa-solid fa-users menu-icon"></i>
              </a>
              </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('schedules.create') }}">
                <span class="menu-title">Create Schedule</span>
                <i class="fa-solid fa-calendar-check menu-icon"></i>
              </a>
              </li>
            @endif
          </ul>
        </nav>