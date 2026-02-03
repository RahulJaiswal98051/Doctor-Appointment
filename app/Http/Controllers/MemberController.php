<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $members = User::paginate(4);
        return view('pages.showMembers', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.addMember');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required|confirmed',
    'password_confirmation' => 'required|same:password',
    'phone' => 'required',
    'address' => 'required',
    'gender' => 'required',
    'role' => 'required',
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
     $user->role = $request->role;
     $status = $request->has('status') ? 1 : 0;
     $user->profile = $input['profile'];
     $user->gender = $request->gender;
     $user->save(); 


   // Redirect to complete doctor profile
    if ($user->role === 'Doctor') {
       return redirect()->route('complete.doctor.profile', ['id' => $user->id])
                        ->with('success', 'Account created! Please complete your doctor profile.');
    }

return redirect ()->route('members.create')->with('success', 'Member added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = User::findOrFail($id);
        return view('pages.viewMember',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = User::findOrFail($id);
        return view('pages.addMember',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
    $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:users,email,' . $id,
        'phone'  => 'required',
        'address'=> 'required',
        'gender' => 'required',
        'role'   => 'required',
        'profile'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $member = User::findOrFail($id);

    $member->name    = $request->name;
    $member->email   = $request->email;
    $member->phone   = $request->phone;
    $member->address = $request->address;
    $member->gender  = $request->gender;
    $member->role    = $request->role;
    $member->status  = $request->has('status') ? 1 : 0;

    if ($request->hasFile('profile')) {
        if ($member->profile && Storage::disk('public')->exists('profile/'.$member->profile)) {
            Storage::disk('public')->delete('profile/'.$member->profile);
        }

        $image = $request->file('profile');
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->storeAs('profile', $profileImage, 'public');
        $member->profile = $profileImage;
    }

    $member->save();

      if ($member->role === 'Doctor') { 
        return redirect()->route('complete.doctor.profile', ['id' => $member->id])
                         ->with('success', 'Updated Succcess! Please complete your doctor profile.');
    }


        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = User::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }

   
}
