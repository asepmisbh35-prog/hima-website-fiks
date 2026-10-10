<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50/50">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 rounded-[2.5rem] transition-all duration-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.08)]">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-50 rounded-3xl mb-6 shadow-sm border border-primary-100">
                    <div class="w-14 h-14 bg-gradient-to-tr from-primary-600 to-primary-400 rounded-2xl flex items-center justify-center shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Atur Ulang Password</h2>
                <p class="mt-3 text-sm text-gray-500 leading-relaxed px-4">
                    Silakan masukkan email dan buat password baru yang lebih kuat.
                </p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" data-turbo="false" class="space-y-5">
                @csrf
                @method('PUT')

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">
                        Email Anda
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $request->email) }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 focus:bg-white transition-all duration-200 outline-none"
                            required 
                            autofocus
                            autocomplete="username"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">
                        Password Baru
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 focus:bg-white transition-all duration-200 outline-none"
                            placeholder="Minimal 8 karakter"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">
                        Konfirmasi Password
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 focus:bg-white transition-all duration-200 outline-none"
                            placeholder="Ulangi password baru"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-1" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full group relative flex items-center justify-center px-6 py-4 bg-primary-600 text-white font-bold rounded-2xl hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-500/30 transition-all duration-300 shadow-lg shadow-primary-500/25 active:scale-[0.97]">
                        <span class="tracking-wide">Simpan Password Baru</span>
                        <svg class="w-5 h-5 ml-2 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-8 text-xs text-gray-400">
            Pastikan password Anda unik dan sulit ditebak.
        </p>
    </div>

    @push('scripts')
    <script>
        // Force disable Turbo for this page
        if (typeof Turbo !== 'undefined') {
            Turbo.session.drive = false;
        }
        
        // Prevent Turbo from intercepting form submission
        document.addEventListener('turbo:before-fetch-request', (event) => {
            event.preventDefault();
        });
    </script>
    @endpush
</x-guest-layout>