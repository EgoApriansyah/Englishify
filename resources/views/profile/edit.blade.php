<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold font-display text-xl text-ink leading-tight font-body">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 font-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
