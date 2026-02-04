@extends('dashboard.User.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-calendar-check"></i> Appointments</h4>
            <a href="{{ route('findDoctors') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> New Appointment
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Doctor</th>
                        <th scope="col"><i class="bi bi-calendar-date"></i> Date</th>
                        <th scope="col"><i class="bi bi-clock"></i> Time</th>
                        <th scope="col"><i class="bi bi-info-circle"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr>
                            <td>
                                @if($appointment->doctor->user->profile)
                                    <img src="{{ asset('storage/profile/' . $appointment->doctor->user->profile) }}" alt="Doctor Profile" class="rounded-circle me-2" width="40" height="40">
                                @endif
                                {{ $appointment->doctor->user->name }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                              <td>
                                @switch($appointment->status)
                                    @case('Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @break
                                    @case('Approved')
                                        <span class="badge bg-success">Approved</span>
                                        @break
                                    @case('Rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                        @break
                                    @case('Cancelled')
                                        <span class="badge bg-secondary">Cancelled</span>
                                        @break
                                    @case('Completed')
                                        <span class="badge bg-info">Completed</span>
                                        @break
                                    
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                <i class="bi bi-exclamation-circle"></i> No appointments found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
               
            </table>
             <!-- Pagination -->
                <div class="mt-3 wrapping-pagination">
                    {{ $appointments->links('pagination::bootstrap-5') }}
                </div>
        </div>
    </div>
</div>
@endsection
