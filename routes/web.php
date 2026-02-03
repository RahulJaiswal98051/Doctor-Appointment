<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\accessCheck;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User Creation or Authentication
Route::get('/', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/loginSubmit', [UserController::class, 'loginSubmit'])->name('loginSubmit')->middleware('guest');
Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('/registerSubmit', [UserController::class, 'store'])->name('registerSubmit')->middleware('guest');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Socialite Authentication
Route::get('/auth/google', [UserController::class, 'googlelogin'])->name('auth.google');
Route::get('/auth/google/callback', [UserController::class, 'googleAuthentication'])->name('auth.google.callback');

// Profile
Route::get('/profileupdate', [UserController::class, 'profile'])->name('profile.update');
Route::post('/profileUpdatestore', [UserController::class, 'profileUpdate'])->name('profile.update.store')->middleware('auth');

// Mail
Route::get('/mail', [MailController::class, 'welcomeMail'])->name('welcome.mail');  


// Dashboard
    Route::get('/admin', [UserController::class, 'admin'])->name('dashboard.admin')->middleware(accessCheck::class . ':Admin');
    Route::get('/doctor', [UserController::class, 'doctor'])->name('dashboard.doctor')->middleware(accessCheck::class . ':Doctor');
    Route::get('/user', [UserController::class, 'user'])->name('dashboard.user')->middleware(accessCheck::class . ':User');


// Mebers Management
Route::resource('/members',MemberController::class );

// Schedules
Route::resource('/schedules', ScheduleController::class);
Route::get('/scheduleShow/{id}', [ScheduleController::class, 'show'])->name('doctor.schedule.show');

// Appointments
Route::resource('/appointments', AppointmentController::class);
Route::get('/myBookings/{id}', [AppointmentController::class, 'userBookings'])->name('myBookings'); //show  appointment details to user
Route::get('/book-appointment/{doctor_id}/{date}/{time}', [AppointmentController::class, 'bookAppointment'])->name('book.appointment');
Route::post('/book-appointmentStore/{doctor_id}/{date}/{time}', [AppointmentController::class, 'storefile'])->name('book.appointment.store');

//doctor 
Route::get('/completeDoctorProfile/{id}', [DoctorController::class, 'completeDoctorProfile'])->name('complete.doctor.profile');
Route::post('/storeDoctorProfile', [DoctorController::class, 'store'])->name('storeDoctorProfile');
Route::get('/findDoctors', [DoctorController::class, 'findDoctors'])->name('findDoctors');
Route::get('/showAppointmentsDoctor/{id}', [DoctorController::class, 'index'])->name('show.appointments.doctor');


// Unauthorized
Route::get('/unauthorized', function() { return view('pages.unauthorized'); })
    ->name('unauthorized');

