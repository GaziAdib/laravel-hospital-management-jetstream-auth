<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
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



     //---- Search Appointments Live------

     public function searchAppointment(Request $request)
     {

        $html = '';
        $searchedAppointments =  Appointment::where('name', 'LIKE', '%'.$request->search.'%')
                 ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                 ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
                 ->orWhere('doctor', 'LIKE', '%'.$request->search.'%')
                 ->orWhere('status', 'LIKE', '%'.$request->search.'%')
                 ->get();

         if($searchedAppointments) {
             foreach($searchedAppointments as $appoint) {
                 $html .= '<tr>
                     <td>'.$appoint->id.'</td>
                     <td>'.$appoint->name.'</td>
                     <td>'.$appoint->email.'</td>
                     <td>'.$appoint->phone.'</td>
                     <td>'.$appoint->doctor.'</td>
                     <td>'.$appoint->date.'</td>
                     <td>'.$appoint->message.'</td>
                     <td>'.$appoint->status.'</td>
                     <td>
                         <a class="btn btn-success" href="'.route('appoint.approve', $appoint->id).'">Approved</a>
                       </td>
                       <td>
                         <a class="btn btn-danger" href="'.route('appoint.cancel', $appoint->id).'">Canceled</a>
                     </td>
                 </tr>';
             }
             return response()->json($html);
         }

     }

}