<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white/90 rounded-xl p-8 shadow-md max-w-md mx-auto mt-10 border border-gray-100">
        @csrf

        <h2 class="text-2xl font-semibold text-[#0B2A4A] mb-6 text-center">Welcome back</h2>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#0B2A4A]" />
            <x-text-input
                id="email"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#0B2A4A]" />
            <x-text-input
                id="password"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-[#D4A017] shadow-sm focus:ring-[#D4A017]"
                    name="remember"
                >
                <span class="ms-2 text-sm text-[#0B2A4A]">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="underline text-sm text-[#0B2A4A]/80 hover:text-[#D4A017] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                    Forgot your password?
                </a>
            @endif

            <x-primary-button class="bg-[#D4A017] hover:bg-[#c49a15] text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
