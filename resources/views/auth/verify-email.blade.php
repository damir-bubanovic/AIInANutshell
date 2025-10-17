<x-guest-layout>
    <div class="bg-white/90 rounded-xl p-8 shadow-md max-w-md mx-auto mt-10 border border-gray-100 text-center">
        <h2 class="text-2xl font-semibold text-[#0B2A4A] mb-4">Verify your email</h2>

        <p class="mb-6 text-sm text-[#0B2A4A]/80">
            Thanks for signing up! Before getting started, please verify your email address by clicking the link we just sent you.
            If you didn’t receive the email, you can request another below.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 border border-green-200 rounded-md py-2 px-3">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
            <!-- Resend Verification -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-primary-button
                    class="w-full bg-[#D4A017] hover:bg-[#c49a15] text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017]">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                        class="w-full sm:w-auto underline text-sm text-[#0B2A4A]/80 hover:text-[#D4A017] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A017] rounded-md">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
