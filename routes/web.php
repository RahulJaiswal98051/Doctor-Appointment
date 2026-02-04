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

//Forgot Password
Route::get('/forgotPassword', [UserController::class, 'forgotPassword'])->name('forgot.password')->middleware('guest');
Route::post('/forgotPasswordSubmit', [UserController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit')->middleware('guest');
Route::get('/resetPassword/{token}', [UserController::class, 'resetPassword'])->name('reset.password')->middleware('guest');
Route::post('/resetPasswordSubmit', [UserController::class, 'resetPasswordSubmit'])->name('reset.password.submit')->middleware('guest');

// Profile
Route::get('/profileupdate', [UserController::class, 'profile'])->name('profile.update')->middleware('auth','accessCheck:Admin,Doctor,User');
Route::post('/profileUpdatestore', [UserController::class, 'profileUpdate'])->name('profile.update.store')->middleware('auth','accessCheck:Admin,Doctor,User');


// Dashboard
    Route::get('/admin', [UserController::class, 'admin'])->name('dashboard.admin')->middleware('auth', 'accessCheck:Admin');
    Route::get('/doctor', [UserController::class, 'doctor'])->name('dashboard.doctor')->middleware('auth','accessCheck:Doctor');
    Route::get('/user', [UserController::class, 'user'])->name('dashboard.user')->middleware('auth','accessCheck:User');


// Mebers Management
Route::resource('/members',MemberController::class )->middleware('auth','accessCheck:Admin');

// Schedules
Route::resource('/schedules', ScheduleController::class)->middleware('auth','accessCheck:Doctor,Admin');
Route::get('/scheduleShow/{id}', [ScheduleController::class, 'show'])->name('doctor.schedule.show')->middleware('auth','accessCheck:User');

// Appointments
Route::resource('/appointments', AppointmentController::class)->middleware('auth','accessCheck:User,Doctor,Admin');
Route::get('/myBookings/{id}', [AppointmentController::class, 'userBookings'])->name('myBookings')->middleware('auth','accessCheck:User'); //show  appointment details to user
Route::get('/book-appointment/{doctor_id}/{date}/{time}', [AppointmentController::class, 'bookAppointment'])->name('book.appointment')->middleware('auth','accessCheck:User');
Route::post('/book-appointmentStore/{doctor_id}/{date}/{time}', [AppointmentController::class, 'storefile'])->name('book.appointment.store')->middleware('auth','accessCheck:User');
Route::patch('/appointmentsComplete/{id}', [DoctorController::class, 'statuscomplete'])->name('appointments.complete')->middleware('auth','accessCheck:Doctor');

//doctor 
Route::get('/completeDoctorProfile/{id}', [DoctorController::class, 'completeDoctorProfile'])->name('complete.doctor.profile')->middleware('auth','accessCheck:Admin,Doctor');
Route::post('/storeDoctorProfile', [DoctorController::class, 'store'])->name('storeDoctorProfile')->middleware('auth','accessCheck:Admin,Doctor');
Route::get('/findDoctors', [DoctorController::class, 'findDoctors'])->name('findDoctors')->middleware('auth','accessCheck:User');
Route::get('/showAppointmentsDoctor/{id}', [DoctorController::class, 'index'])->name('show.appointments.doctor')->middleware('auth','accessCheck:Doctor');


// Unauthorized
Route::get('/unauthorized', function() { return view('pages.unauthorized'); })
    ->name('unauthorized');

