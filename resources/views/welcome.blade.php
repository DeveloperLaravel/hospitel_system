<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستشفى الشروق</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50
             dark:from-gray-900 dark:via-gray-900 dark:to-gray-800
             font-sans text-gray-800 dark:text-gray-200">

<!-- Navbar -->
<nav class="backdrop-blur bg-white/80 dark:bg-gray-900/80 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex justify-between items-center">
        <h1 >
                   <img src="{{ asset('images/2.png') }}" alt="" srcset=""class="text-lg md:text-2xl font-bold text-blue-600">
 مستشفى الشروق
        </h1>


    </div>
</nav>

<!-- Hero -->
<section class="min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 gap-10 items-center">

        <div class="text-center md:text-right">
            <h2 class="text-3xl md:text-5xl font-extrabold leading-tight">
                نظام إدارة
                <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">
                    مستشفى الشروق
                </span>
            </h2>

            <p class="mt-6 text-gray-600 dark:text-gray-300 text-base md:text-lg leading-relaxed">
                منصة ذكية لإدارة المستشفيات تشمل المرضى والأطباء والمواعيد
                والأشعة والتحاليل الطبية ولوحة تحكم متقدمة.
            </p>

            <div class="mt-8 flex flex-wrap gap-4 justify-center md:justify-start">
                <a href="/login"
                   class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition">
                    دخول النظام
                </a>

                <a href="#features"
                   class="px-6 py-3 border border-blue-500 text-blue-600 rounded-xl hover:bg-blue-50 dark:hover:bg-gray-800 transition">
                    استكشف النظام
                </a>
            </div>
        </div>

        <div class="hidden md:block">
            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3"
                 class="rounded-3xl shadow-2xl">
        </div>
    </div>
</section>

<!-- Features -->
<section id="features" class="py-20">
    <div class="max-w-7xl mx-auto px-4 md:px-6">

        <h2 class="text-3xl font-bold text-center mb-14">
            مميزات النظام
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card -->
            <div class="p-6 bg-white/80 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="font-bold text-lg text-blue-600 mb-2">إدارة المرضى</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    تسجيل المرضى ومتابعة بياناتهم الطبية بسهولة.
                </p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="font-bold text-lg text-blue-600 mb-2">إدارة الأطباء</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    تنظيم التخصصات والجدولة والمعلومات الطبية.
                </p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="font-bold text-lg text-blue-600 mb-2">إدارة المواعيد</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    نظام حجز ومتابعة مواعيد المرضى.
                </p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="font-bold text-lg text-blue-600 mb-2">الأشعة والتحاليل</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    إدارة طلبات الأشعة والتحاليل الطبية.
                </p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="font-bold text-lg text-blue-600 mb-2">نظام صلاحيات</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    تحكم كامل في المستخدمين والأدوار.
                </p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="font-bold text-lg text-blue-600 mb-2">تقارير وإحصائيات</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    لوحة تحكم تحليلية لإدارة المستشفى.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Roles -->
<section class="py-20 bg-white/70 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 md:px-6">

        <h2 class="text-3xl font-bold text-center mb-12">
            الصلاحيات داخل النظام
        </h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">

            <div class="p-6 bg-gradient-to-br from-blue-600 to-cyan-500 text-white rounded-2xl shadow text-center">
                المدير
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow text-center">
                الطبيب
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow text-center">
                الممرض
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow text-center">
                الاستقبال
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-8 text-center">
        © {{ date('Y') }} مستشفى الشروق
    </div>
</footer>

</body>
</html>
