<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}"
          class="bg-white/90 rounded-xl p-8 shadow-md max-w-md mx-auto mt-10 border border-gray-100">
        @csrf

        <h2 class="text-2xl font-semibold text-[#0B2A4A] mb-4 text-center">Forgot your password?</h2>

        <p class="mb-6 text-sm text-[#0B2A4A]/80 text-center">
            No problem. Enter your email address and we’ll send you a password reset link.
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

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
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button
                class="bg-[#D4A017] hover:bg-[#c49a15] text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
