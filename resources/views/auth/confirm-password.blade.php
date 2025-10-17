<x-guest-layout>
    <form method="POST" action="{{ route('password.confirm') }}"
          class="bg-white/90 rounded-xl p-8 shadow-md max-w-md mx-auto mt-10 border border-gray-100">
        @csrf

        <h2 class="text-2xl font-semibold text-[#0B2A4A] mb-4 text-center">Confirm your password</h2>

        <p class="mb-6 text-sm text-[#0B2A4A]/80 text-center">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <!-- Password -->
        <div>
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

        <div class="flex justify-end mt-6">
            <x-primary-button
                class="bg-[#D4A017] hover:bg-[#c49a15] text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
