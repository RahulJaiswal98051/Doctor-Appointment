@extends('dashboard.includes.layout')
@section('content')

<div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card">
                  <div class="card-header">Create Schedule</div> 
                <div class="card-body">
                   
                      {{-- Success Message  --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                      {{-- Error Messages   --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                            
<form action="{{ isset($schedule) ? route('schedules.update', $schedule->id) : route('schedules.store') }}" 
      method="POST">
    @csrf
    @if(isset($schedule))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" 
               value="{{ isset($schedule) ? $schedule->date : old('date') }}" required>
    </div>

    <div class="form-group">
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" id="start_time" class="form-control" 
               value="{{ isset($schedule) ? $schedule->start_time : old('start_time') }}" required>
    </div>

    <div class="form-group">
        <label for="end_time">End Time</label>
        <input type="time" name="end_time" id="end_time" class="form-control"
               value="{{ isset($schedule) ? $schedule->end_time : old('end_time') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($schedule) ? 'Update Schedule' : 'Create Schedule' }}
    </button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
