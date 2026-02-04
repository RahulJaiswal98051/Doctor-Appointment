<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\User;
use App\Models\Schedule;
use Carbon\Carbon;

class DoctorController extends Controller
{

    public function index() 
    {
        $doctorProfile = DoctorProfile::where('user_id', auth()->id())->first();
        $appointments = Appointment::with('user') 
        ->where('doctor_id', $doctorProfile->id)
        ->where('status', 'Approved')
        ->orderBy('date', 'desc')
        ->orderBy('time', 'desc')
        ->paginate(5);

    return view('dashboard.Doctor.showAppointment', compact('appointments'));      
}


     public function completeDoctorProfile($id){
        $user = User::findOrFail($id);
        $profile=DoctorProfile::where('user_id', $id)->first();
        return view('pages.completeDoctorProfile', compact('user','profile'));
    }
    
     public function store(Request $request){
        
     $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialization' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'consultation_fee' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        DoctorProfile::updateOrCreate(
            ['user_id' => $request->user_id], 
            [
                'specialization' => $request->specialization,
                'experience' => $request->experience,
                'degree' => $request->degree,
                'consultation_fee' => $request->consultation_fee,
                'status' => $request->status,
            ] 
        ); 

        return redirect()->route('dashboard.admin')->with('success', 'Doctor profile completed successfully.');
    }

       public function findDoctors(Request $request)
    {
        $today = Carbon::today()->toDateString();

        // Load doctors with only their upcoming schedules (dates >= today)
        $doctors = DoctorProfile::with([
            'user',
            // Load only upcoming schedules, ordered by date
            'schedules' => function($q) use ($today) {
                $q->where('date', '>=', $today)
                  ->orderBy('date', 'asc');
                //   ->limit(3); 
            },
            // Load appointments for upcoming dates
            'appointments' => function($q) use ($today) {
                $q->whereNotIn('status', ['Cancelled', 'Rejected'])
                  ->where('date', '>=', $today);
            }
        ])
        ->where('status', 1) // Only show active doctors
        ->get();

        // Get distinct specializations for filter dropdown
        $specializations = DoctorProfile::where('status', 1)
            ->select('specialization')
            ->distinct()
            ->orderBy('specialization', 'asc')
            ->pluck('specialization');
        
        return view('dashboard.User.findDoctor', compact('doctors', 'specializations')); 
    }



        public function getAvailableSlots(Request $request, $doctorId)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $date = $request->date;
        
        // Get schedule for the date
        $schedule = Schedule::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->first();

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'No schedule available for this date'
            ]);
        }

        // Get booked appointments for this date
        $bookedTimes = Appointment::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->whereNotIn('status', ['Cancelled', 'Rejected'])
            ->pluck('time')
            ->map(function($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        // Generate time slots
        $slots = [];
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $now = Carbon::now();

        while ($startTime < $endTime) {
            $slotTime = $startTime->format('H:i');
            $displayTime = $startTime->format('h:i A');
            
            // Skip if slot is booked
            if (in_array($slotTime, $bookedTimes)) {
                $startTime->addMinutes(30);
                continue;
            }

            // Skip if slot is in the past (only for today)
            if ($date === Carbon::today()->toDateString() && $startTime->lt($now)) {
                $startTime->addMinutes(30);
                continue;
            }

            $slots[] = [
                'time' => $slotTime,
                'display' => $displayTime,
                'available' => true
            ];

            $startTime->addMinutes(30);
        }

        return response()->json([
            'success' => true,
            'slots' => $slots,
            'schedule' => [
                'start' => Carbon::parse($schedule->start_time)->format('h:i A'),
                'end' => Carbon::parse($schedule->end_time)->format('h:i A')
            ]
        ]);
    }


  

}
