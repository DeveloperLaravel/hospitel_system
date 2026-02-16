<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BedAssignmentController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\RadiologyController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard', [DashboardController::class,'index'])
//     ->middleware(['auth'])
//     ->name('dashboard');



Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard', [DashboardController::class,'index'])
//     ->middleware(['auth'])
//     ->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard عام للجميع
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users & Roles & Permissions فقط للمستخدمين الذين لديهم صلاحيات
    Route::resource('users', UserController::class)->middleware('permission:users.view');
    Route::resource('roles', RoleController::class)->middleware('permission:roles.view');
    Route::resource('permissions', PermissionController::class)->middleware('permission:permissions.view');

    // Departments
    Route::resource('departments', DepartmentController::class)
        ->middleware('permission:departments.view');

    // Doctors
    Route::resource('doctors', DoctorController::class)
        ->middleware('permission:doctors.view');

    // Patients (عرض للجميع)
    Route::resource('patients', PatientController::class);

    // Appointments
    Route::resource('appointments', AppointmentController::class)
        ->middleware('permission:appointments.view');

    // Bed Assignments
    Route::resource('bed_assignments', BedAssignmentController::class)
        ->middleware('permission:bed.view');

    // Medical Records
    Route::resource('medical_records', MedicalRecordController::class)
        ->middleware('permission:medical_records.view');

    // Medicines
    Route::resource('medicines', MedicineController::class)
        ->middleware('permission:medicines.view');

    // Prescriptions
    Route::resource('prescriptions', PrescriptionController::class)
        ->middleware('permission:prescriptions.view');

    // Lab Tests
    Route::resource('lab_tests', LabTestController::class)
        ->middleware('permission:labtest.view');
    Route::patch('lab_tests/{labTest}/complete', [LabTestController::class,'complete'])
        ->name('lab_tests.complete')
        ->middleware('permission:labtest.complete');

    // Radiologies
    Route::resource('radiologies', RadiologyController::class)
        ->middleware('permission:radiology.view');
    Route::patch('radiologies/{radiology}/complete', [RadiologyController::class,'complete'])
        ->name('radiologies.complete')
        ->middleware('permission:radiology.complete');

    // Invoices
    Route::resource('invoices', InvoiceController::class)
        ->middleware('permission:invoices.view');
    Route::resource('invoice_items', InvoiceItemController::class)
        ->middleware('permission:invoice_items.view');

    // Rooms & Nurses
    Route::resource('rooms', RoomController::class)
        ->middleware('permission:rooms.view');
    Route::resource('nurses', NurseController::class)
        ->middleware('permission:nurses.view');
});

require __DIR__.'/auth.php';
