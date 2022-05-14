<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;





Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/home', [HomeController::class, 'redirect'])->middleware(['auth', 'verified']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




// All Routes For Admin

Route::get('/show-appointments', [AppointmentController::class, 'showAppointment'])->name('show.appointment');
Route::get('/admin-add-doctor', [DoctorController::class, 'create'])->name('add.doctors');
Route::post('/admin-add-doctor', [DoctorController::class, 'store'])->name('store.doctors');
Route::get('/approve-appointment/{id}', [AppointmentController::class, 'approveAppointment'])->name('appoint.approve');
Route::get('/cancel-appointment/{id}', [AppointmentController::class, 'cancelAppointment'])->name('appoint.cancel');
Route::get('/show-doctors', [DoctorController::class, 'showDoctors'])->name('show.doctors');
Route::get('/delete-doctor/{id}', [DoctorController::class, 'deleteDoctor'])->name('doctor.delete');
Route::get('/edit-doctor/{id}', [DoctorController::class, 'editDoctor'])->name('doctor.edit');
Route::post('/update-doctor/{id}', [DoctorController::class, 'updateDoctor'])->name('doctor.update');

// Search Doctor From Admin
Route::get('/search-doctor', [DoctorController::class, 'searchDoctor'])->name('doctor.search');
Route::get('/search-appointment', [AppointmentController::class, 'searchAppointment'])->name('appointment.search');

// email send View
Route::get('/email-view/{id}', [AppointmentController::class, 'emailView'])->name('email.view');


// email send via notification
Route::post('/email-send/{id}', [AppointmentController::class, 'emailSend'])->name('email.send');









// POST User To Appointment
Route::post('/appointment', [HomeController::class, 'appointment'])->name('appointment.store');

// show all Appointment Current User Have
Route::get('/myappointment', [HomeController::class, 'myappointment'])->name('myappointment.index');


// Delete Appointment Current User
Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancelMyAppointment'])->name('appointment.cancel');


