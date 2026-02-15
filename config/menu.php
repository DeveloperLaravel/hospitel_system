<?php

return [
    ['route'=>'dashboard','icon'=>'🏠','label'=>'الرئيسية','permission'=>null],
    ['route'=>'users.index','icon'=>'👤','label'=>'المستخدمين','permission'=>'users.view'],
    ['route'=>'roles.index','icon'=>'🛡️','label'=>'الأدوار','permission'=>'roles.view'],
    ['route'=>'permissions.index','icon'=>'🔑','label'=>'الصلاحيات','permission'=>'permissions.view'],
    ['route'=>'departments.index','icon'=>'🏢','label'=>'الأقسام','permission'=>'departments.view'],
    ['route'=>'doctors.index','icon'=>'🩺','label'=>'الأطباء','permission'=>'doctors.view'],
    ['route'=>'patients.index','icon'=>'🧑‍⚕️','label'=>'المرضى','permission'=>'patients.view'],
    ['route'=>'appointments.index','icon'=>'📅','label'=>'المواعيد','permission'=>'appointments.view'],
    ['route'=>'medicines.index','icon'=>'💊','label'=>'الأدوية','permission'=>'medicines.view'],
    ['route'=>'medical_records.index','icon'=>'📋','label'=>'السجلات الطبية','permission'=>'medical_records.view'],
    ['route'=>'lab_tests.index','icon'=>'🧪','label'=>'التحاليل المخبرية','permission'=>'labtest.view'],
    ['route'=>'radiologies.index','icon'=>'🩻','label'=>'الأشعة','permission'=>'radiology.view'],
    ['route'=>'invoices.index','icon'=>'🧾','label'=>'الفواتير','permission'=>'invoices.view'],
    ['route'=>'rooms.index','icon'=>'🛏️','label'=>'الغرف','permission'=>'rooms.view'],
    ['route'=>'nurses.index','icon'=>'👩‍⚕️','label'=>'الممرضات','permission'=>'nurses.view'],
];
