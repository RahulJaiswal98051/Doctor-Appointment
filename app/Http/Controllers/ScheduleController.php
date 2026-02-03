<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.createSchedule');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], );

        
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $doctorProfile = DoctorProfile::where('user_id', auth()->user()->id)->first();  //this is for getting the doctor profile
        $schedule = new Schedule();
        $schedule->user_id = auth()->user()->id;
        $schedule->doctor_id = $doctorProfile->id;
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->save();
        return redirect()->route('dashboard.doctor')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $schedules = Schedule::with('user')->where('doctor_id', $id)->get();    //this is for displaying the schedule of doctor to user
        $appointments = null;
        $selectedDate = $request->input('date');
        $hasAppointment = false;
        if ($selectedDate) {
            $appointments = Appointment::with('user')->where('doctor_id', $id)->where('date', $selectedDate)->get();
            $hasAppointment = Appointment::where('user_id', auth()->user()->id)->where('doctor_id', $id)->where('date', $selectedDate)->exists();
        }
        return view('dashboard.User.showSchedule', compact('schedules', 'appointments', 'selectedDate', 'hasAppointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = Schedule::where('id', $id)->first();
        return redirect()->route('schedules.create', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
