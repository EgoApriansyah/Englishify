<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-display-sm font-display text-ink">Selamat Datang Kembali</h2>
        <p class="text-body-sm text-muted mt-2">Masuk untuk melanjutkan pembelajaran di Englishify</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-label text-muted uppercase tracking-widest mb-2 font-body font-semibold">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="block w-full pl-11 pr-4 py-3 bg-canvas border border-hairline text-ink placeholder-muted rounded-sm focus:border-green focus:ring-4 focus:ring-green/15 focus:outline-none transition duration-150 text-body-md font-medium" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div x-data="{ showPassword: false }">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-label text-muted uppercase tracking-widest font-body font-semibold">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-body-sm font-semibold text-green hover:text-green-dark transition-colors">
                        Lupa Kata Sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0V10.5m-2.25 13.5h13.5c1.242 0 2.25-1.008 2.25-2.25V11.25c0-1.242-1.008-2.25-2.25-2.25H5.25c-1.242 0-2.25 1.008-2.25 2.25v11.25c0 1.242 1.008 2.25 2.25 2.25Z" />
                    </svg>
                </div>
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                    class="block w-full pl-11 pr-11 py-3 bg-canvas border border-hairline text-ink placeholder-muted rounded-sm focus:border-green focus:ring-4 focus:ring-green/15 focus:outline-none transition duration-150 text-body-md font-medium" placeholder="Masukkan kata sandi" />
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted hover:text-ink transition-colors">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="flex items-center cursor-pointer select-none group">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="rounded-sm border-hairline text-green shadow-sm focus:border-green focus:ring-4 focus:ring-green/15 focus:ring-offset-0 size-4.5 cursor-pointer transition duration-150" />
                <span class="ms-2.5 text-body-sm font-semibold text-ink group-hover:text-green transition-colors">
                    Ingat saya di perangkat ini
                </span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full group flex items-center justify-center gap-2 py-3 px-4 border border-transparent rounded-md text-body-md font-semibold text-white bg-green hover:bg-green-dark focus:outline-none focus:ring-4 focus:ring-green/15 transition duration-150 shadow-md transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                Masuk
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-150 shrink-0">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </div>

        <div class="text-center mt-6 pt-4 border-t border-hairline">
            <p class="text-body-sm text-muted font-semibold">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-green hover:text-green-dark transition-colors">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

