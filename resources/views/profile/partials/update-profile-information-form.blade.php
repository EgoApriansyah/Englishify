<section class="font-body">
    <header>
        <h2 class="text-lg font-semibold font-display text-ink">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-muted font-body">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Image Upload -->
        <div class="flex items-center gap-6 pb-2">
            <div class="relative shrink-0" id="avatar-container">
                @if($user->profile_image)
                    <img id="avatar-preview" src="{{ asset('storage/' . $user->profile_image) }}" class="w-20 h-20 rounded-full object-cover border border-hairline shadow-sm" alt="Avatar">
                @else
                    <div id="avatar-fallback" class="w-20 h-20 rounded-full bg-green text-white font-bold text-2xl flex items-center justify-center border border-hairline shadow-sm">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                @endif
            </div>
            
            <div class="space-y-1">
                <x-input-label for="profile_image" :value="__('Foto Profil')" />
                <input id="profile_image" name="profile_image" type="file" 
                       class="block w-full text-xs text-muted
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-xs file:font-semibold
                              file:bg-green/10 file:text-green-dark
                              hover:file:bg-green/20
                              cursor-pointer file:cursor-pointer" 
                       accept="image/*"
                       onchange="previewImage(event)" />
                <p class="text-[10px] text-muted font-normal">PNG, JPG, atau WEBP (Maksimal 2MB).</p>
                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-ink">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-muted hover:text-green-dark rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-semibold text-sm text-green">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green font-semibold"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatar-preview');
                    const fallback = document.getElementById('avatar-fallback');
                    const container = document.getElementById('avatar-container');
                    
                    if (preview) {
                        preview.src = e.target.result;
                    } else if (fallback) {
                        const img = document.createElement('img');
                        img.id = 'avatar-preview';
                        img.src = e.target.result;
                        img.className = 'w-20 h-20 rounded-full object-cover border border-hairline shadow-sm';
                        img.alt = 'Avatar';
                        container.innerHTML = '';
                        container.appendChild(img);
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</section>
