<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // users
            'user.view','user.create','user.edit','user.delete',

            // departments
            'department.view','department.create','department.edit','department.delete',

            // doctors
            'doctor.view','doctor.create','doctor.edit','doctor.delete',

            // nurses
            'nurse.view','nurse.create','nurse.edit','nurse.delete',

            // patients
            'patient.view','patient.create','patient.edit','patient.delete',

            // appointments
            'appointment.view','appointment.create','appointment.edit','appointment.delete',

            // lab tests
            'labtest.view','labtest.create','labtest.edit','labtest.delete','labtest.complete',

            // radiology
            'radiology.view','radiology.create','radiology.edit','radiology.delete','radiology.complete',

            // medicines
            'medicine.view','medicine.create','medicine.edit','medicine.delete',

            // invoices
            'invoice.view','invoice.create','invoice.edit','invoice.delete',

            // rooms
            'room.view','room.create','room.edit','room.delete',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $doctor = Role::firstOrCreate(['name' => 'doctor']);
        $nurse = Role::firstOrCreate(['name' => 'nurse']);
        $reception = Role::firstOrCreate(['name' => 'reception']);
        $pharmacist = Role::firstOrCreate(['name' => 'pharmacist']);
        $labTech = Role::firstOrCreate(['name' => 'lab']);
        $radiologyTech = Role::firstOrCreate(['name' => 'radiology']);

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions
        |--------------------------------------------------------------------------
        */

        // Super Admin → كل شيء
        $superAdmin->givePermissionTo(Permission::all());

        // Admin
        $admin->givePermissionTo([
            'user.view','user.create','user.edit',
            'department.view','department.create','department.edit',
            'doctor.view','doctor.create','doctor.edit',
            'nurse.view','nurse.create','nurse.edit',
            'patient.view','patient.create','patient.edit',
            'appointment.view','appointment.create','appointment.edit',
            'invoice.view','invoice.create',
            'room.view','room.create','room.edit',
        ]);

        // Doctor
        $doctor->givePermissionTo([
            'patient.view',
            'appointment.view',
            'labtest.view','labtest.create','labtest.complete',
            'radiology.view','radiology.create','radiology.complete',
        ]);

        // Nurse
        $nurse->givePermissionTo([
            'patient.view',
            'room.view',
        ]);

        // Reception
        $reception->givePermissionTo([
            'patient.view','patient.create','patient.edit',
            'appointment.view','appointment.create','appointment.edit',
            'invoice.view','invoice.create',
        ]);

        // Pharmacist
        $pharmacist->givePermissionTo([
            'medicine.view','medicine.create','medicine.edit',
        ]);

        // Lab Technician
        $labTech->givePermissionTo([
            'labtest.view','labtest.complete'
        ]);

        // Radiology Technician
        $radiologyTech->givePermissionTo([
            'radiology.view','radiology.complete'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */


        $adminUser = User::firstOrCreate(
            ['email' => 'hnarfr20063@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('love308277'),
            ]
        );
        $adminUser->assignRole('admin');

        $doctorUser = User::firstOrCreate(
            ['email' => 'doctor@hospital.com'],
            [
                'name' => 'Doctor',
                'password' => Hash::make('password'),
            ]
        );
        $doctorUser->assignRole('doctor');

        $receptionUser = User::firstOrCreate(
            ['email' => 'reception@hospital.com'],
            [
                'name' => 'Reception',
                'password' => Hash::make('password'),
            ]
        );
        $receptionUser->assignRole('reception');
    }
}
