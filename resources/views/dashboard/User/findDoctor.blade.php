<style>
    .doctor-profile-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid white;
    }

    .slot-btn {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        white-space: nowrap;
        text-decoration: none; /* Ensure links look like buttons */
        display: inline-block;
    }

    .slot-btn:hover {
        background-color: var(--bs-primary);
        color: white;
        border-color: var(--bs-primary);
    }

    .slot-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.25rem;
        justify-items: center;
    }

    .doctor-card-container {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .doctor-card-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0;
        margin-bottom: 2rem;
    }

    .hero-section h1, .hero-section p {
        color: white;
    }

    .schedule-column {
        min-height: 200px;
    }

    @media (max-width: 768px) {
        .schedule-column {
            border-right: none !important;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        .schedule-column:last-child {
            border-bottom: none;
        }

        .doctor-profile-img {
            height: 200px;
        }

        .col-md-4 {
            margin-bottom: 1rem;
        }
    }
</style>

@extends('dashboard.user.layout')
@section('content')

<div class="hero-section text-center shadow-sm">
    <div class="container">
        <h1 class="display-5 fw-bold text-primary mb-3">Find Your Specialist</h1>
        <p class="lead text-muted mb-4">Book appointments with top doctors in your area</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="input-group input-group-lg shadow-sm bg-white rounded-pill overflow-hidden p-1">
                    <span class="input-group-text bg-white border-0 ps-3">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-0" 
                           placeholder="Search by Doctor Name...">
                    <div class="border-start my-2"></div>
                    <select id="specializationFilter" class="form-select border-0" style="max-width: 200px;">
                        <option value="">All Specializations</option>
                        @foreach($specializations as $spec)
                            <option value="{{ strtolower($spec) }}">{{ $spec }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div id="doctorList">
        @foreach($doctors as $doctor)
        <div class="card mb-4 border-0 shadow-sm doctor-card doctor-card-container">
            <div class="row g-0">
                <div class="col-md-4 col-lg-3 border-end">
                    <div class="position-relative">
                        <img src="{{ asset('storage/profile/' . $doctor->user->profile) }}" 
                             class="doctor-profile-img" 
                             alt="{{ $doctor->user->name }}">
                        <span class="status-badge {{ $doctor->status ? 'bg-success' : 'bg-danger' }}"></span>
                    </div>
                    <div class="p-3 text-center">
                        <h5 class="fw-bold mb-1 doctor-name">Dr. {{ $doctor->user->name }}</h5>
                        <p class="text-primary fw-medium mb-1 doctor-specialist">{{ $doctor->specialization }}</p>
                        
                       <div class="mb-3 text-warning small">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        (4.8)
                        </div>

                        <ul class="list-unstyled text-muted small text-start ps-3 mb-3">
                            <li class="mb-1">
                                <i class="bi bi-briefcase me-2"></i>{{ $doctor->experience }}
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-mortarboard me-2"></i>{{ $doctor->degree }}
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-cash me-2"></i>RS {{ $doctor->consultation_fee }} Consultation Fee
                            </li>
                        </ul>

                                {{-- <a href="{{ route('', $doctor->id) }}" 
                                class="btn btn-outline-primary w-100 rounded-pill btn-sm">
                                    View Profile
                                </a> --}}
                    </div>
                </div>

                <div class="col-md-8 col-lg-9 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold m-0 text-secondary">
                            <i class="bi bi-calendar-check me-2"></i>Upcoming Availability
                        </h6>
                        <a href="{{ route('doctor.schedule.show', $doctor->id) }}" 
                           class="text-decoration-none small">
                            See all <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    @if($doctor->schedules->count() > 0)
                        <div class="row text-center h-100">
                            @php
                                $upcomingSchedules = $doctor->schedules->take(3);
                                $today = \Carbon\Carbon::today()->toDateString();
                            @endphp

                            @foreach($upcomingSchedules as $index => $schedule)
                                @php
                                    $scheduleDate = \Carbon\Carbon::parse($schedule->date);
                                    $isToday = $scheduleDate->toDateString() === $today;
                                    $isTomorrow = $scheduleDate->toDateString() === \Carbon\Carbon::tomorrow()->toDateString();
                                    
                                    // Get booked times for this specific date
                                    $bookedTimes = $doctor->appointments
                                        ->filter(function($appt) use ($scheduleDate) {
                                            return \Carbon\Carbon::parse($appt->date)->toDateString() === $scheduleDate->toDateString();
                                        })
                                        ->pluck('time')
                                        ->map(function($time) {
                                            return \Carbon\Carbon::parse($time)->format('H:i');
                                        })
                                        ->toArray();
                                @endphp

                                <div class="col-md-4 schedule-column {{ $index < 2 ? 'border-end' : '' }}">
                                    <div class="mb-3 border-bottom pb-2">
                                        <span class="d-block fw-bold date-header-text {{ $isToday ? 'text-primary' : '' }}">
                                            @if($isToday)
                                                Today
                                            @elseif($isTomorrow)
                                                Tomorrow
                                            @else
                                                {{ $scheduleDate->format('l') }}
                                            @endif
                                        </span>
                                        <span class="text-muted small">{{ $scheduleDate->format('M d, Y') }}</span>
                                    </div>
                                    
                                    <div class="slot-grid">
                                        @php
                                            $startTime = \Carbon\Carbon::parse($schedule->start_time);
                                            $endTime = \Carbon\Carbon::parse($schedule->end_time);
                                            $displayedSlots = 0;
                                            $now = \Carbon\Carbon::now();
                                        @endphp

                                        @while($startTime < $endTime)
                                            @php
                                                $slotTime = $startTime->format('H:i');
                                                $displayTime = $startTime->format('h:i A');

                                                $isBooked = in_array($slotTime, $bookedTimes);

                                                $isPast = false;
                                                if ($isToday) {
                                                    $slotDateTime = \Carbon\Carbon::parse($scheduleDate->toDateString() . ' ' . $slotTime);
                                                    $isPast = $slotDateTime->lt($now);
                                                }
                                            @endphp

                                            @if(!$isBooked && !$isPast)

                                                <a href="{{ route('book.appointment', [
                                                        'doctor_id' => $doctor->id,
                                                        'date' => $scheduleDate->toDateString(),
                                                        'time' => urlencode($slotTime)
                                                   ]) }}"
                                                   class="btn btn-outline-secondary slot-btn">
                                                    {{ $displayTime }}
                                                </a>
                                                @php $displayedSlots++; @endphp
                                            @endif

                                            @php
                                                $startTime->addMinutes(30);
                                            @endphp
                                        @endwhile

                                        @if($displayedSlots == 0)
                                            <span class="text-muted small d-block w-100 py-2">All slots booked</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            @if($upcomingSchedules->count() < 3)
                                @for($i = $upcomingSchedules->count(); $i < 3; $i++)
                                    <div class="col-md-4 schedule-column {{ $i < 2 ? 'border-end' : '' }}">
                                        <div class="mb-3 border-bottom pb-2">
                                            <span class="d-block fw-bold text-muted">-</span>
                                            <span class="text-muted small">No schedule</span>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-center gap-1">
                                            <span class="text-muted small d-block w-100 py-2">-</span>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    @else
                        <div class="alert alert-light text-center mb-0">
                            <i class="bi bi-calendar-x text-muted fs-1 d-block mb-2"></i>
                            <p class="text-muted mb-0">No upcoming schedules available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="noResults" class="text-center py-5 d-none">
        <div class="mb-3">
            <i class="bi bi-search display-1 text-muted opacity-25"></i>
        </div>
        <h4 class="text-muted">No doctors found matching your criteria</h4>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Doctor filtering logic
    function filterDoctors() {
        let searchValue = document.getElementById('searchInput').value.toLowerCase();
        let specializationValue = document.getElementById('specializationFilter').value.toLowerCase();
        let doctorCards = document.querySelectorAll('.doctor-card-container');
        let hasVisibleCards = false;

        doctorCards.forEach(function(card) {
            let name = card.querySelector('.doctor-name').textContent.toLowerCase();
            let specialist = card.querySelector('.doctor-specialist').textContent.toLowerCase();

            let matchesSearch = name.includes(searchValue);
            let matchesSpecialization = !specializationValue || specialist.includes(specializationValue);

            if (matchesSearch && matchesSpecialization) {
                card.style.display = "block";
                hasVisibleCards = true;
            } else {
                card.style.display = "none";
            }
        });

        document.getElementById('noResults').classList.toggle('d-none', hasVisibleCards);
    }

    document.getElementById('searchInput').addEventListener('keyup', filterDoctors);
    document.getElementById('specializationFilter').addEventListener('change', filterDoctors);
</script>

@endsection