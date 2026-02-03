@extends('dashboard.includes.layout')
@section('content')

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"> Appointments</h4>
                    <!-- <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-rounded"><i class="fa-solid fa-user-plus"></i></a> -->
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Doctor</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time</th>
                                <th class="text-center" >Status</th>
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
                                    <td>{{ $appointment->date }}</td>
                                     <td>{{ $appointment->time }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>
                                        <div class ="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-inverse-warning btn-rounded">view</a>
                                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-inverse-primary btn-rounded"><i class="fa-solid fa-user-pen"></i></a>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
    @csrf                           
    @method('DELETE')
    <button type="submit" class="btn btn-inverse-danger btn-rounded" onclick="return confirm('Are you sure? delete this appointment')">
        <i class="fa-solid fa-trash-can"></i>
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
