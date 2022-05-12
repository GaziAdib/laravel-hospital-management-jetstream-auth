<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class DoctorController extends Controller
{


    // Add Doctor Form
    public function create()
    {
        return view('admin.doctors.add_doctors');
    }


    // Add Doctor from Admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'speciality' => 'required',
            'room' => 'required'
        ]);

        $image = $request->image;
        $imgName = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 500)->save(public_path('doctor_images/'.$imgName));

        Doctor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'speciality' => $request->speciality,
            'room' => $request->room,
            'image' => 'doctor_images/'.$imgName
        ]);

        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }


     // Show All doctors in Admin Section

     public function showDoctors()
     {
         $doctors = Doctor::latest()->get();
         return view('admin.doctors.show_doctors', compact('doctors'));
     }


     // Delete Doctor

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


    // ----- Search Doctor Live-----

    public function searchDoctor(Request $request)
    {

       $html = '';
       $searchedDoctors =  Doctor::where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
                ->orWhere('speciality', 'LIKE', '%'.$request->search.'%')
                ->orWhere('room', 'LIKE', '%'.$request->search.'%')
                ->get();

        if($searchedDoctors) {
            foreach($searchedDoctors as $doctor) {
                $html .= '<tr>
                    <td>'.$doctor->id.'</td>
                    <td>'.$doctor->name.'</td>
                    <td>'.$doctor->phone.'</td>
                    <td>'.$doctor->speciality.'</td>
                    <td>'.$doctor->room.'</td>
                    <td>
                        <img src="'.asset($doctor->image).'" height="200px;" width="200px;" alt="">
                    </td>
                    <td>
                        <a class="btn btn-success" href="'.route('doctor.edit', $doctor->id).'">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="'.route('doctor.delete', $doctor->id).'">Delete</a>
                    </td>
                </tr>';
            }
            return response()->json($html);
        }

    }


}
