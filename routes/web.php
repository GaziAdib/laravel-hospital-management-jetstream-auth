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
Route::get('/admin-add-doctor', [AdminController::class, 'create'])->name('add.doctors');
Route::post('/admin-add-doctor', [AdminController::class, 'store'])->name('store.doctors');

// All Route for User To Appoint
Route::post('/appointment', [HomeController::class, 'appointment'])->name('appointment.store');





