<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentStatusMail;
use App\Mail\AppointmentStatusDoctor;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $appointments = Appointment::with('user','doctor')->paginate(5); // Appointments show to admin 
        return view('dashboard.Admin.showappointment', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor_profiles,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = 'pending';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment requested successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id )
    {
        
    }
       

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
{
    $request->validate([
        'status' => 'required|in:Pending,Approved,Rejected,Completed,Cancelled',
    ]);

    $appointment->status = $request->status;
    $appointment->save();

    
    $appointment->load('user', 'doctor');
    // dd($appointment);

    // Send email to patient
    Mail::to($appointment->user->email)
        ->send(new AppointmentStatusMail($appointment));

   //  Send email to doctor
   $doctormail = User::where ('id', $appointment->doctor->user_id)->first();
    Mail::to($doctormail->email)
        ->send(new AppointmentStatusDoctor($appointment));
   return redirect()->back()
       ->with('success', 'Appointment status updated and email sent successfully.');
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    /**
     * Show the booking form for appointment with file upload.
     */
    public function bookAppointment($doctor_id, $date, $time)
    {
        $doctor = DoctorProfile::with('user')->findOrFail($doctor_id);
        return view('pages.bookAppointment', compact('doctor', 'date', 'time'));
    }

    /**
     * Store appointment with file upload.
     */
    public function storeFile(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor_profiles,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'payment_recept' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = 'Pending';

        if ($request->hasFile('payment_recept')) {
            $file = $request->file('payment_recept');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/payment_recepts'), $filename);
            $appointment->payment_recept = $filename;
        }

        $appointment->save();

        return redirect()->route('dashboard.user')->with('success', 'Appointment booked successfully. Waiting for approval.');
    }

    public function userBookings($id)
    {
        
        $appointments = Appointment::with('doctor.user')
            ->where('user_id', $id)
            ->orderBy('date', 'desc')
            ->paginate(5);

        return view('dashboard.User.myBooking', compact('appointments'));
    }
}
