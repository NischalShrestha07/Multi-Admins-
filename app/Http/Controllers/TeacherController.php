<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teacher.form');
    }

    public function changePassword()
    {
        return view('student.changePassword');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
            //confirmPassword should mactch with newPassword

        ]);
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $user = User::find(Auth::user()->id); //find user
        // dd($user);

        if (Hash::check($oldPassword, $user->password)) { //checked wheather the password is correct or not

            $user->password = $newPassword;
            $user->update();
            return redirect()->back()->with('success', 'Password Changed Successfully.');
        } else {
            return redirect()->back()->with('error', 'Old Password Does not match.');
        }
    }





    public function login()
    {
        return view('teacher.login');
    }

    public function register()
    {

        $user = new User();
        $user->name = 'Teacher';
        $user->role = 'teacher';
        $user->email = 'teacher@gmail.com';
        $user->password = Hash::make('admin');
        $user->save(); // if not written then it will not show details in Database.
        return redirect()->route('teacher.login')->with('success', 'Teacher created successfully.');
    }
    public function authenticate(Request $req)
    {
        //checks the required data and sends the error message tologin i not filled.
        $req->validate([
            'email' => 'required',
            'password' => 'required'

        ]);
        // dd($req->all());
        if (Auth::guard('teacher')->attempt(['email' => $req->email, 'password' => $req->password])) {
            if (Auth::guard('teacher')->user()->role != 'teacher') {
                Auth::guard('teacher')->logout();
                return redirect()->route('teacher.login')->with('error', 'Unauthorized user. Access Denied.');
            }
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('teacher.login')->with('error', 'Something went wrong');
        }
    }
    public function dashboard()
    {
        // echo 'Welcome' . Auth::guard('teacher')->user()->name;
        return view('teacher.dashboard');
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success', 'Logged Out SuccessFully.');
    }
}
