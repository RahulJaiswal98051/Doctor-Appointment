<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;  
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;



class UserController extends Controller
{
    public function index()
    {
        return view('');
    }

    public function googlelogin(){

        return Socialite::driver('google')->redirect();
    }
    public function googleAuthentication() {
        $user = Socialite::driver('google')->user();

        $isUser = User::where('email', $user->email)->first();

        if ($isUser) {
            Auth::login($isUser);
            switch(Auth::user()->role){
            case 'Admin':
                return redirect()->route('dashboard.admin');
            case 'Doctor':
                return redirect()->route('dashboard.doctor');
            case 'User':
                return redirect()->route('dashboard.user');
            default:
                return redirect()->route('login')->with('error', 'Something went wrong');
            }
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('str::random(10)'),
                // 'role' => 'User'
            ]);
    }

        Auth::login($newUser);
        return redirect()->route('dashboard.user');
    }


    public function login()
    {
        return view('pages.login');
    }

    public function loginSubmit(Request $request){

    // dd($request->all());
     $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    
    $credentials = $request->only('email','password');

    if (Auth::attempt($credentials, true)) {
      

            switch(Auth::user()->role){
            case 'Admin':
                return redirect()->route('dashboard.admin');
            case 'Doctor':
                return redirect()->route('dashboard.doctor');
            case 'User':
                return redirect()->route('dashboard.user');
            default:
                return redirect()->route('login')->with('error', 'Something went wrong');
            }
        } 
        else {
            return redirect()->route('login')->with('error', 'Invalid email or password');
        }

    }

    public function register(){
        return view('pages.register');
    }


    public function store(Request $request){
       
    // dd($request->all());
    $request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required|confirmed',
    'password_confirmation' => 'required|same:password',
    'phone' => 'required',
    'address' => 'required',
    'gender' => 'required',
    'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
   ]);

    if ($request->email) {
    $user = User::where('email', $request->email)->first();
    if ($user) {
        return redirect(route('register'))->with('error', 'Email already exists');
    }
    }

       if ($image = $request->file('profile')) {
    $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    $path = $image->storeAs('profile', $profileImage, 'public');
    $input['profile'] = $profileImage;
    }

     $user = new User;
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make($request->password);
     $user->phone = $request->phone;
     $user->address = $request->address;
     $user->profile = $input['profile'];
     $user->gender = $request->gender;
     $user->save(); 
     return redirect()-> route('login')-> with ('success', 'Registration successfully');
            
    }

    public function admin(){
        $appointments = Appointment::all();
        $totalAppointments = $appointments->count();
        $completedAppointments = $appointments->where('status', 'Completed')->count();
        return view('dashboard.Admin.admin',compact('totalAppointments','completedAppointments'));
    }

    public function doctor(){
        return view('dashboard.Doctor.doctor');
    }

    public function profile(){
        return view('pages.updateProfile');
    }

    public function profileUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable',
        ]);
        $user = auth()->user();
        $input = [];
        if ($image = $request->file('profile')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $path = $image->storeAs('profile', $profileImage, 'public');
            $input['profile'] = $profileImage;
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if (isset($input['profile'])) {
            $user->profile = $input['profile'];
        }
        $user->gender = $request->gender;
        $user->save();
        return redirect()->route('profile.update')->with('success', 'Profile updated successfully');
    }

   public function user(){
    $doctors = DoctorProfile::with('user')->take(3)->get();
    return view('dashboard.User.user', compact('doctors'));
}
    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout successfully');
    }

    public function forgotPassword(){
        return view('pages.forgotPassword');
    }

    public function forgotPasswordSubmit(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        
        Mail::send('mail.forgotPassword', ['token' => $token, 'email' => $request->email], function($message) use($request){
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        return redirect()->route('login')->with('success', 'Password reset link has been sent to your Email');
    }

    public function resetPassword($token ){
        return view('pages.resetPassword', ['token' => $token]);
    }

    public function resetPasswordSubmit(Request $request)
{
    $request->validate([
        'token' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $reset = DB::table('password_reset_tokens')
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->with('error', 'Invalid or expired token');
    }

    if (Carbon::parse($reset->created_at)->addMinutes(5)->isPast()) {
        return back()->with('error', 'Token expired');
    }

    User::where('email', $reset->email)
        ->update([
            'password' => Hash::make($request->password)
        ]);

    DB::table('password_reset_tokens')
        ->where('email', $reset->email)
        ->delete();

    return redirect()->route('login')
        ->with('success', 'Password reset successfully');
}


    
}
