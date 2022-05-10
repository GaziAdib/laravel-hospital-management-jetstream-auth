<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;





Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/home', [HomeController::class, 'redirect']);

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

Route::get('/show-appointments', [AdminController::class, 'showAppointment'])->name('show.appointment');
Route::get('/admin-add-doctor', [AdminController::class, 'create'])->name('add.doctors');
Route::post('/admin-add-doctor', [AdminController::class, 'store'])->name('store.doctors');
Route::get('/approve-appointment/{id}', [AdminController::class, 'approveAppointment'])->name('appoint.approve');
Route::get('/cancel-appointment/{id}', [AdminController::class, 'cancelAppointment'])->name('appoint.cancel');



// POST User To Appointment
Route::post('/appointment', [HomeController::class, 'appointment'])->name('appointment.store');

// show all Appointment Current User Have
Route::get('/myappointment', [HomeController::class, 'myappointment'])->name('myappointment.index');


// Delete Appointment Current User
Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancelMyAppointment'])->name('appointment.cancel');


