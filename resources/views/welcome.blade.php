<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستشفى الشروق</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-500">

    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl md:text-2xl font-bold text-blue-600 flex items-center gap-2 transition-transform duration-200 hover:scale-105 active:scale-95">
                🏥 مستشفى الشروق
            </h1>


        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

            <!-- النص -->
            <div class="text-center md:text-right">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 dark:text-white leading-tight transition-colors duration-500">
                    مرحباً بكم في
                    <span class="text-blue-600 dark:text-blue-400">مستشفى الشروق</span>
                </h2>

                <p class="mt-6 text-gray-600 dark:text-gray-300 text-lg md:text-xl leading-relaxed transition-colors duration-500">
                    نقدم رعاية صحية متكاملة باستخدام أحدث التقنيات الطبية
                    وبإشراف نخبة من الأطباء لضمان أفضل تجربة علاجية للمرضى على مدار الساعة.
                </p>

                <div class="mt-8 flex flex-wrap gap-4 justify-center md:justify-start">
                    <a href="#"
                       class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow-lg
                              hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600
                              transition transform duration-200
                              active:scale-95 active:brightness-90">
                        احجز موعد
                    </a>

                    <a href="/login"
                       class="px-6 py-3 border border-blue-600 text-blue-600 dark:text-blue-400 rounded-xl
                              hover:bg-blue-50 dark:hover:bg-gray-800
                              transition transform duration-200
                              active:scale-95 active:brightness-90">
                        دخول النظام
                    </a>
                </div>
            </div>

            <!-- الصورة -->
            <div class="hidden md:block">
                <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3"
                     class="rounded-2xl shadow-lg w-full h-auto transform transition-transform duration-300 hover:scale-105 active:scale-95"
                     alt="hospital">
            </div>

        </div>
    </section>

<!-- Footer -->
<footer class="bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-300 transition-colors duration-500 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">

        <!-- شعار ورسالة -->
        <div>
            <h2 class="text-2xl font-bold text-blue-600 dark:text-blue-400 flex items-center gap-2 mb-4">
                🏥 مستشفى الشروق
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base leading-relaxed">
                تقديم رعاية صحية متكاملة وآمنة، مع أفضل الأطباء والمرافق الحديثة لخدمة مجتمعنا.
            </p>
        </div>

        <!-- الروابط السريعة -->
        <div>
            <h3 class="font-semibold text-gray-700 dark:text-gray-200 mb-4">الروابط السريعة</h3>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300">
                        الصفحة الرئيسية
                    </a>
                </li>
                <li>
                    <a href="#services" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300">


</body>
</html>
