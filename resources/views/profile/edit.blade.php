<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold font-display text-xl text-ink leading-tight font-body">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 font-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(Auth::user() && Auth::user()->role === 'admin')
                <div class="p-4 sm:p-8 bg-purple-50 rounded-lg border border-purple-200 shadow-card flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-purple-900">Panel Administrasi</h3>
                        <p class="text-sm text-purple-700 mt-1">Anda masuk sebagai Admin. Akses panel manajemen akun dan statistik di sini.</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2.5 px-5 rounded-lg transition-colors whitespace-nowrap">
                        Buka Panel Admin
                    </a>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-canvas rounded-lg border border-hairline shadow-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-canvas rounded-lg border border-hairline shadow-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-canvas rounded-lg border border-hairline shadow-card">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
