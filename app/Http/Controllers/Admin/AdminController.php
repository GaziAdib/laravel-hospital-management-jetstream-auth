<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;



class AdminController extends Controller
{

    public function create()
    {
        return view('admin.doctors.add_doctors');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'speciality' => 'required',
            'room' => 'required'
        ]);

        //$image = $manager->make('public/foo.jpg')->resize(300, 200);
        $image = $request->image;
        $imgName = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 500)->save(public_path('doctor_images/'.$imgName));
        //$image->move(public_path('doctor_images', $imgName));


        Doctor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'speciality' => $request->speciality,
            'room' => $request->room,
            'image' => 'doctor_images/'.$imgName
        ]);

        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }


}