<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RfidController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/rfid/scan', [RfidController::class, 'scanPage'])->name('rfid.scan');
    Route::post('/rfid/scan', [RfidController::class, 'scan'])->name('rfid.process');

    
    Route::resource('students', StudentController::class);

    
    Route::resource('attendance', AttendanceController::class);
    Route::get('/attendance-report', [AttendanceController::class, 'report'])->name('attendance.report');
    Route::get('/attendance-export', [AttendanceController::class, 'exportCsv'])->name('attendance.export');
});

require __DIR__.'/auth.php';
