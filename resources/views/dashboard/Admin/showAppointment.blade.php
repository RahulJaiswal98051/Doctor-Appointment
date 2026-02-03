@extends('dashboard.includes.layout')
@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Appointments</h4>
                    <!-- Uncomment if you want to add new appointment -->
                    <!-- <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-rounded">
                        <i class="fa-solid fa-user-plus"></i>
                    </a> -->
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Payment Receipt</th>
                                <th class="text-center">Doctor</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>
                                        {{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        @if($appointment->user->profile)
                                            <img src="{{ url('storage/profile/'.$appointment->user->profile) }}" width="40" height="40" class="rounded-circle mr-2">
                                        @endif
                                        {{ $appointment->user->name }}
                                    </td>
                                    <td>
                                        @if($appointment->payment_recept)
                                            <img src="{{ url('storage/payment_recepts/'.$appointment->payment_recept) }}" width="40" height="40" class="rounded mr-2">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($appointment->doctor->user->profile)
                                            <img src="{{ url('storage/profile/'.$appointment->doctor->user->profile) }}" width="40" height="40" class="rounded-circle mr-2">
                                        @endif
                                        {{ $appointment->doctor->user->name }}
                                    </td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                                    <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Approved" {{ $appointment->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="Rejected" {{ $appointment->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="btn btn-inverse-primary btn-rounded ms-2">
                                                    <i class="fa-solid fa-pen-to-square"></i> Update
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 wrapping-pagination">
                    {{ $appointments->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
