<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body
    x-data="{ darkMode: false }"
    x-init="
        darkMode = localStorage.getItem('dark') === 'true';
        document.documentElement.classList.toggle('dark', darkMode);
    "
    :class="darkMode ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-800'"
    class="transition-colors duration-500"
>


<div x-data="{ open: false }" class="flex min-h-screen">

    <!-- Overlay (Mobile Only) -->
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
         @click="open = false"
         x-transition>
    </div>

    <!-- Sidebar -->
    <aside
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed lg:static z-40 inset-y-0 left-0 w-64
               bg-white dark:bg-gray-800 shadow-lg
               transform lg:translate-x-0
               transition-transform duration-300 ease-in-out">

        <div class="p-4 font-bold text-red-600 text-lg border-b dark:border-gray-700">
            🏥 المستشفى
        </div>

      <nav
     class="space-y-2 px-3 py-4">

    <!-- Dark Mode Button -->
   <button
    @click="
        darkMode = !darkMode;
        document.documentElement.classList.toggle('dark', darkMode);
        localStorage.setItem('dark', darkMode);
    "
    class="w-full flex items-center gap-3 p-2 rounded-lg
           bg-gray-100 dark:bg-gray-700
           hover:bg-red-100 dark:hover:bg-gray-600
           transition font-semibold"
>
    <span x-text="darkMode ? '☀️' : '🌙'"></span>
    <span x-text="darkMode ? 'الوضع النهاري' : 'الوضع الليلي'"></span>
</button>

    <!-- Dashboard -->
    <a href="/dashboard"
       class="flex items-center gap-3 p-2 rounded-lg
              hover:bg-red-100 dark:hover:bg-gray-700
              transition transform hover:scale-[1.02]">
        📊
        <span>Dashboard</span>
    </a>

    <!-- Doctors -->
    <a href="/doctors"
       class="flex items-center gap-3 p-2 rounded-lg
              hover:bg-red-100 dark:hover:bg-gray-700
              transition transform hover:scale-[1.02]">
        👨‍⚕️
        <span>الأطباء</span>
    </a>

    <!-- Patients -->
    <a href="/patients"
       class="flex items-center gap-3 p-2 rounded-lg
              hover:bg-red-100 dark:hover:bg-gray-700
              transition transform hover:scale-[1.02]">
        🧑‍🦽
        <span>المرضى</span>
    </a>

    <!-- Appointments -->
    <a href="/appointments"
       class="flex items-center gap-3 p-2 rounded-lg
              hover:bg-red-100 dark:hover:bg-gray-700
              transition transform hover:scale-[1.02]">
        📅
        <span>المواعيد</span>
    </a>
    <!-- Profile -->
    <a href="{{ route('profile.edit') }}"
       class="flex items-center gap-3 p-2 rounded-lg
              hover:bg-red-100 dark:hover:bg-gray-700
              transition transform hover:scale-[1.02]">
        👤
        <span>الملف الشخصي</span>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center gap-3 p-2 rounded-lg
                   hover:bg-red-100 dark:hover:bg-gray-700
                   transition transform hover:scale-[1.02] text-left">
            🚪
            <span>تسجيل الخروج</span>
        </button>
    </form>

</nav>

    </aside>


    <!-- Content -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center">

            <!-- زر يظهر فقط في الموبايل -->
            <button @click="open = !open"
                    class="lg:hidden bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded">
                ☰
            </button>

            <h1 class="font-semibold text-gray-700 dark:text-gray-200">
                لوحة التحكم
            </h1>

            <!-- Notifications -->
            <div class="relative cursor-pointer">
                🔔
                <span class="absolute -top-2 -right-2 bg-red-500 text-white
                             text-xs px-2 py-0.5 rounded-full">
                    3
                </span>
            </div>

        </header>

        <main class="p-4 sm:p-6 flex-1">
            {{ $slot }}
        </main>

    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
