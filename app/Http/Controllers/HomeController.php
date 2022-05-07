<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{

    // FrontEnd Index Users Page
    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('user.home', compact('doctors'));
    }


    // Redirect Based on User And Admin
    public function redirect()
    {
        if(Auth::id()) {

            if(Auth::user()->user_type=='0') {
                return view('user.home');
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




}
