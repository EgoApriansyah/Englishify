<x-guest-layout>
    <div class="mb-4 text-body-sm text-muted font-body">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-body font-semibold text-body-sm text-green">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-body-sm text-muted hover:text-ink rounded-sm focus:outline-none focus:ring-4 focus:ring-green/15 font-body font-semibold">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>

