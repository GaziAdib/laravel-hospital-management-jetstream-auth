<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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

    // show all apointments in Admin Panel

    public function showAppointment()
    {
        $appointments = Appointment::latest()->get();
        return view('admin.appointments.show_appointments', compact('appointments'));
    }

    // Approve Appointments
    public function approveAppointment($id)
    {
        $data = Appointment::find($id);
        $data->status = 'approved';
        $data->save();

        return redirect()->back()->with('message', 'Appointment Approved Successfully');
    }

    // Cancel Appointments
    public function cancelAppointment($id)
    {
        $data = Appointment::find($id);
        $data->status = 'cancelled';
        $data->save();

        return redirect()->back()->with('message', 'Appointment Cancelled Successfully');
    }

    // Show All doctors in Admin Section

    public function showDoctors()
    {
        $doctors = Doctor::latest()->get();
        return view('admin.doctors.show_doctors', compact('doctors'));
    }


    //Delete Doctor

    public function deleteDoctor($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();

        return redirect()->back()->with('message', 'Doctor Deleted Successfully');
    }

    // Edit Doctor

    public function editDoctor($id)
    {
        $doctor = Doctor::find($id);
        return view('admin.doctors.edit_doctor', compact('doctor'));
    }


    // Update Doctor

    public function updateDoctor(Request $request, $id)
    {


        if($request->image) {
            $image = $request->image;
            $imgName = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(400, 500)->save(public_path('doctor_images/'.$imgName));

            Doctor::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'speciality' => $request->speciality,
                'room' => $request->room,
                'image' => 'doctor_images/'.$imgName
            ]);
            return redirect()->back()->with('message', 'Doctor Updated Successfully');
        } else {
            Doctor::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'speciality' => $request->speciality,
                'room' => $request->room
            ]);
            return redirect()->back()->with('message', 'Doctor Updated Successfully');
        }


    }

}
