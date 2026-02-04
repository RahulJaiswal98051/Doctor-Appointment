@extends('dashboard.user.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white p-3">
                    <h4 class="mb-0"><i class="bi bi-cash-stack me-2"></i>Complete Your Payment</h4>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Appointment Info --}}
                    <div class="alert alert-info border-0 shadow-sm mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h6 class="fw-bold mb-1">Appointment with Dr. {{ $doctor->user->name }}</h6>
                                <p class="mb-0 small">
                                    <i class="bi bi-calendar-event me-1"></i> 
                                    {{ $date ? \Carbon\Carbon::parse($date)->format('l, d M Y') : 'Date not selected' }} 
                                    <span class="mx-2">|</span>
                                    <i class="bi bi-clock me-1"></i> 
                                    {{ \Carbon\Carbon::parse($time)->format('h:i A') }}
                                </p>
                            </div>
                            <div class="col-md-5 text-md-end mt-2 mt-md-0">
                                <span class="h5 fw-bold text-primary">RS {{ $doctor->consultation_fee }}</span>
                                <div class="small text-muted">Consultation Fee</div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Section --}}
                    <div class="row g-4">
                        <div class="col-md-5 text-center border-end">
                            <h5 class="text-secondary mb-3">1. Scan QR Code</h5>
                            <div class="bg-light p-3 rounded">
                                <img src="{{ asset('storage/profile/paymentqr.jpeg') }}"
                                     alt="Payment QR Code"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-width: 180px;">
                            </div>
                            <p class="mt-3 small text-muted">Scan using your banking app to pay the fee shown above.</p>
                        </div>

                        <div class="col-md-7">
                            <h5 class="text-secondary mb-3">2. Upload Receipt</h5>
                            <form action="{{ route('book.appointment.store', ['doctor_id' => $doctor->id, 'date' => $date, 'time' => $time]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                                <input type="hidden" name="time" value="{{ $time }}">

                                <div class="mb-3">
                                    <label for="payment_recept" class="form-label fw-bold">Payment Receipt (Image)</label>
                                    <input type="file" 
                                           class="form-control @error('payment_recept') is-invalid @enderror" 
                                           id="payment_recept" 
                                           name="payment_recept" 
                                           required>
                                    @error('payment_recept')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Please upload a Receipt of your successful transaction.</div>
                                </div>

                                <div class="d-grid gap-2 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                        Confirm & Book Appointment
                                    </button>
                                    <a href="{{ route('findDoctors') }}" class="btn btn-link text-muted">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
