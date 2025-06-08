<?php

namespace App\Http\Controllers\StudentPanel\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student;
use Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin(){
        return view('student-panel.auth.login');
    }

    public function showSignup(){
        return view('student-panel.auth.signup');
    }

    public function signup(Request $request){
        // dd($request);

        $request->validate([
            'matricule' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|unique:students',
        ]);


        student::create([
            'matricule' => $request->matricule,
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('student.login')->with('message', 'Signup Successful');
    }


    public function login(Request $request){

        // dd($request);
        $request->validate([
            'matricule' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt(['matricule' => $request->matricule, 'password' => $request->password])) {
            return redirect()->route('student.books');
        } else {
            return redirect()->back()->withErrors(['matricule' => 'Invalid matricule or password']);
        }
    }
}
