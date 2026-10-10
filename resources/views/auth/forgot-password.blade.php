<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50/50">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 rounded-[2.5rem] transition-all duration-300 hover:shadow-[0_20px_50px_rgba(0,0,0,0.08)]">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-50 rounded-3xl mb-6 shadow-sm border border-primary-100">
                    <div class="w-14 h-14 bg-gradient-to-tr from-primary-600 to-primary-400 rounded-2xl flex items-center justify-center shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Lupa Password?</h2>
                <p class="mt-3 text-sm text-gray-500 leading-relaxed px-4">
                    Masukkan email Anda untuk menerima instruksi pemulihan akun.
                </p>
            </div>

            <form method="POST" action="{{ route('password.email') }}" data-turbo="false" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">
                        Alamat Email
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
                            value="{{ old('email') }}"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 focus:bg-white transition-all duration-200 outline-none"
                            placeholder="nama@email.com"
                            required 
                            autofocus
                        >
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                @if (session('status'))
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 animate-in fade-in slide-in-from-top-4 duration-500">
                        <div class="flex items-center text-emerald-800 text-sm font-medium">
                            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                <div class="pt-2 space-y-4">
                    <button type="submit" class="relative w-full group overflow-hidden px-6 py-4 bg-primary-600 text-white font-bold rounded-2xl hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-500/30 transition-all duration-300 shadow-lg shadow-primary-500/25 active:scale-[0.97]">
                        <span class="relative z-10 flex items-center justify-center tracking-wide">
                            Kirim Instruksi
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </button>

                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-2 text-sm font-semibold text-gray-500 hover:text-primary-600 transition-colors duration-200 group">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali Login
                    </a>
                </div>
            </form>
        </div>

        <p class="mt-8 text-xs text-gray-400">
            &copy; {{ date('Y') }} Sistem Anda. Keamanan adalah prioritas kami.
        </p>
    </div>
</x-guest-layout>