<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        // Cards
        $patientsCount = Patient::count();
        $doctorsCount = Doctor::count();
        $appointmentsCount = Appointment::count();
        $departmentsCount = Department::count();

        // Appointments per day
        $appointmentsByDay = Appointment::selectRaw('DAYNAME(date) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total','day');

        // Patients by gender
        $patientsByGender = Patient::selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->pluck('total','gender');

        return view('dashboard', compact(
            'patientsCount',
            'doctorsCount',
            'appointmentsCount',
            'departmentsCount',
            'appointmentsByDay',
            'patientsByGender'
        ));
    }
}
