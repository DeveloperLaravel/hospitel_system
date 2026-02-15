<x-guest-layout>

        <!-- Login Form -->
        <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700 dark:text-gray-200"/>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 start-0 flex items-center ps-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 12H8m0 0l4 4m0-4l-4-4"></path>
                            </svg>
                        </span>
                        <x-text-input id="email" class="block w-full ps-10 pr-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700 dark:text-gray-200"/>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 start-0 flex items-center ps-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 11c1.657 0 3 .895 3 2v1H9v-1c0-1.105 1.343-2 3-2z"></path>
                                <path d="M12 11V7a4 4 0 00-4 4v4h8v-4a4 4 0 00-4-4z"></path>
                            </svg>
                        </span>
                        <x-text-input id="password" class="block w-full ps-10 pr-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center text-gray-600 dark:text-gray-300">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-sm">{{ __('تذكرني') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200" href="{{ route('password.request') }}">
                            {{ __('نسيت كلمة المرور؟') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <x-primary-button class="w-full py-2 mt-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors">
                    {{ __('تسجيل الدخول') }}
                </x-primary-button>
            </form>
        </div>

        <!-- Footer -->
        <footer class="mt-6 text-gray-500 dark:text-gray-400 text-sm text-center">
            © {{ date('Y') }} مستشفى الشروق — جميع الحقوق محفوظة
        </footer>
    </div>
</x-guest-layout>
