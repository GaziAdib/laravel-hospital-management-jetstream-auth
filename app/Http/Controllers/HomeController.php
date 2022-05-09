<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{

    // FrontEnd Index Users Page
    public function index()
    {
        if(Auth::id()){
            return redirect('home');
        } else {
            $doctors = Doctor::latest()->get();
            return view('user.home', compact('doctors'));
        }

    }


    // Redirect Based on User And Admin
    public function redirect()
    {
        if(Auth::id()) {

            if(Auth::user()->user_type=='0') {
                $doctors = Doctor::latest()->get();
                return view('user.home', compact('doctors'));
            }
            else {
                return view('admin.home');
            }
        }
         else
        {
            return redirect()->back();
        }
    }


    // Add an Appointment for users

    public function appointment(Request $request)
    {

        //dd(Auth::user());

        // validations
        $request->validate([
            'doctor' => 'required',
            'date' => 'required'
        ]);

    //if User is Authenticated Then Only He/she can appoint to Doctor
        if(Auth::check()) {

            Appointment::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' =>  Auth::user()->phone,
                'doctor' => $request->doctor,
                'date' => $request->date,
                'message' => $request->message,
                'status' => 'In Progress',
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('message', 'Appointment Request Successfull . We Will Contact With You Soon.');

        }

        else {

            //if user in Guest he can appoint with His given info

            Appointment::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' =>  $request->phone,
                'doctor' => $request->doctor,
                'date' => $request->date,
                'message' => $request->message,
                'status' => 'In Progress',
            ]);

            return redirect()->back()->with('message', 'Guests Appointment Request Successfull . We Will Contact With You Soon.');
        }


    }


}
