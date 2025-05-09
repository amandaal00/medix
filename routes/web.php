<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\PolyController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\MedicalRequestController;
use App\Http\Controllers\MedicalAccessController;
use App\Http\Controllers\CheckupController;

// Landing Page
Route::get('/', fn() => view('site.index'));

// Authentication Routes
Route::get('/login', function () {
    if(authAs('admin')) return redirect('/admin');
    if(authAs('doctor')) return redirect('/workspace');
    if(authAs('pharmacist')) return redirect('/pharmacy');
    if(authAs('patient')) return redirect('/appointment');
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register');

// Patient Routes
Route::middleware(['auth', 'check_role:patient'])->group(function () {
    Route::resource('appointment', AppointmentController::class)->only(['index', 'store']);
});

// Doctor Routes
Route::middleware(['auth', 'check_role:doctor'])->group(function () {
    Route::resource('workspace', WorkspaceController::class)->only(['index', 'update']);
    Route::post('schedule', [WorkspaceController::class, 'schedule']);
    Route::get('schedule/switch-status', [WorkspaceController::class, 'switch_status']);
    Route::get('history/{user}', [WorkspaceController::class, 'history']);
});

// Pharmacist Routes
Route::middleware(['auth', 'check_role:pharmacist'])->group(function () {
    Route::get('pharmacy', [WorkspaceController::class, 'pharmacy']);
});

// Shared Routes (Doctor, Pharmacist, Patient)
Route::middleware(['auth', 'check_role:doctor,pharmacist,patient'])->group(function () {
    Route::resource('setting', SettingController::class)->only(['index', 'update']);
    Route::post('profile', [SettingController::class, 'update_profile']);
    Route::post('change-password', [SettingController::class, 'change_password']);
    Route::get('checkup/{checkup}', [AppointmentController::class, 'checkup']);
    Route::put('checkup/{checkup}', [AppointmentController::class, 'update']);
    Route::put('checkup/status/{checkup}', [AppointmentController::class, 'update_status']);
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'check_role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class)->except(['create']);
    Route::resource('poly', PolyController::class)->except(['create']);
    Route::resource('medicine', MedicineController::class)->except(['create']);
    Route::resource('schedule', ScheduleController::class)->except(['create']);
});

// Medical Request Routes
Route::prefix('medical-request')->middleware('auth')->group(function () {
    Route::get('/', [MedicalRequestController::class, 'index'])->name('medical-request.index');
    Route::post('/', [MedicalRequestController::class, 'store'])->name('medical-request.store');
    Route::put('/{id}/approve', [MedicalRequestController::class, 'approve'])->name('medical-request.approve');
    Route::post('/{id}/reject', [MedicalRequestController::class, 'reject'])->name('medical-request.reject');
});

// Medical Access Routes
Route::prefix('medical-access')->middleware('auth')->group(function () {
    Route::post('/request/{patientId}', [MedicalAccessController::class, 'requestAccess'])
        ->name('medical-access.request')
        ->middleware('check_role:doctor');

    Route::put('/respond/{requestId}', [MedicalAccessController::class, 'respondAccess'])
        ->name('medical-access.respond')
        ->middleware('check_role:patient');
});

// Checkup Routes
Route::middleware(['auth', 'check_role:doctor,patient'])->group(function () {
    Route::get('/history/{patient}', [CheckupController::class, 'history'])->name('checkup.history');
    Route::get('/checkups', [CheckupController::class, 'index'])->name('checkup.index');
});

Route::get('/about', function () {
    return view('site.about');
});

Route::get('/services', function () {
    return view('site.services');
});

Route::get('/doctors', function () {
    return view('site.doctors');
});