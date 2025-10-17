<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}"
          class="bg-white/90 rounded-xl p-8 shadow-md max-w-md mx-auto mt-10 border border-gray-100">
        @csrf

        <!-- Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h2 class="text-2xl font-semibold text-[#0B2A4A] mb-4 text-center">Reset your password</h2>

        <p class="mb-6 text-sm text-[#0B2A4A]/80 text-center">
            Enter your email and choose a new password below.
        </p>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#0B2A4A]" />
            <x-text-input
                id="email"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="email"
                name="email"
                :value="old('email', $request->email)"
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
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#0B2A4A]" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button
                class="bg-[#D4A017] hover:bg-[#c49a15] text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
