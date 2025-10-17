<x-guest-layout>
    <form method="POST" action="{{ route('register') }}"
          class="bg-white/90 rounded-xl p-8 shadow-md max-w-md mx-auto mt-10 border border-gray-100">
        @csrf

        <h2 class="text-2xl font-semibold text-[#0B2A4A] mb-6 text-center">Create your account</h2>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[#0B2A4A]" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-[#0B2A4A]" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#0B2A4A]" />
            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="password"
                name="password"
                required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#0B2A4A]" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-[#D4A017] focus:ring-[#D4A017]"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}"
               class="underline text-sm text-[#0B2A4A]/80 hover:text-[#D4A017] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                Already registered?
            </a>

            <x-primary-button class="bg-[#D4A017] hover:bg-[#c49a15] text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
