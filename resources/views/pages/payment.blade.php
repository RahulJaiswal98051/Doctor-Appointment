@extends('dashboard.includes.layout')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Create Payment</h4>

                <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- User -->
                    <div class="form-group mb-3">
                        <label for="user_id">User</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Appointment -->
                    <div class="form-group mb-3">
                        <label for="appointment_id">Appointment</label>
                        <select name="appointment_id" id="appointment_id" class="form-select" required>
                            <option value="">-- Select Appointment --</option>
                            @foreach($appointments as $appointment)
                                <option value="{{ $appointment->id }}">
                                    {{ $appointment->doctor->user->name }} | {{ $appointment->date }} {{ $appointment->time }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div class="form-group mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>

                    <!-- Payment Receipt -->
                    <div class="form-group mb-3">
                        <label for="payment_recept">Payment Receipt</label>
                        <input type="text" name="payment_recept" id="payment_recept" class="form-control" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="fa-solid fa-save"></i> Save Payment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
