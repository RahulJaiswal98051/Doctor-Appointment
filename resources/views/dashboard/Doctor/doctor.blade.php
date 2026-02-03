@extends('dashboard.includes.layout')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-bold">Today's Visits</p>
                        <h2 class="mb-0">14</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="fas fa-calendar-check text-primary fa-lg"></i>
                    </div>
                </div>
                <div class="mt-3 small">
                    <span class="text-success"><i class="fas fa-arrow-up"></i> 12%</span>
                    <span class="text-muted ms-2">Since yesterday</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-bold">Operations</p>
                        <h2 class="mb-0">3</h2>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                        <i class="fas fa-microscope text-danger fa-lg"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">Next at 2:30 PM</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-bold">New Patients</p>
                        <h2 class="mb-0">8</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="fas fa-user-plus text-success fa-lg"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">4 awaiting registration</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-bold">Lab Alerts</p>
                        <h2 class="mb-0">2</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="fas fa-flask text-warning fa-lg"></i>
                    </div>
                </div>
                <div class="mt-3 small text-danger fw-bold">Action required</div>
            </div>
        </div>
    </div>
</div>
@endsection
