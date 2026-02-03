@extends('dashboard.includes.layout')
@section('content')

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Your Appointments</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Status</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td class="text-center">
                                        {{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        @if($appointment->user->profile)
                                            <img src="{{ url('storage/profile/'.$appointment->user->profile) }}" width="40" height="40" class="rounded-circle me-2">
                                        @endif
                                        {{ $appointment->user->name }}
                                    </td>
                                    <td class="text-center">{{ $appointment->date }}</td>
                                    <td class="text-center">{{ $appointment->time }}</td>
                                    <td class="text-center">{{ $appointment->status }}</td>
                                   
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
