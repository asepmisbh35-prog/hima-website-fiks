<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- FOTO PROFILE --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1 h-6 bg-primary-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Foto Profile</h3>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" data-turbo="false" id="photo-form">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" id="remove-photo" name="remove_photo" value="0">
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">

                            {{-- Avatar --}}
                            <div class="flex-shrink-0 flex flex-col items-center gap-4">
                                <div class="relative group">
                                    @if(!$user->photo)
                                        <div id="photo-preview-placeholder"
                                             class="w-28 h-28 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-4xl font-bold shadow-md select-none">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif

                                    <img
                                        id="photo-preview"
                                        src="{{ $user->photo ? asset('storage/' . $user->photo) . '?v=' . time() : '' }}"
                                        alt="Profile Photo"
                                        class="{{ $user->photo ? '' : 'hidden' }} w-28 h-28 rounded-full object-cover shadow-md border-4 border-white ring-2 ring-primary-200">

                                    <button
                                        type="button"
                                        onclick="document.getElementById('profile_photo').click()"
                                        class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer"
                                        aria-label="Ganti foto"
                                    >
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ $user->name }}</span>
                            </div>

                            {{-- Controls --}}
                            <div class="flex-1 flex flex-col gap-4 justify-center">
                                <input
                                    type="file"
                                    id="profile_photo"
                                    name="photo"
                                    accept="image/jpeg,image/jpg,image/png"
                                    class="hidden"
                                    onchange="previewPhoto(event)"
                                >

                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Upload foto profile kamu.
                                    <br>
                                    <span class="text-gray-400 text-xs">Format: JPG, JPEG, PNG · Maks. 2MB</span>
                                </p>

                                <div class="flex flex-wrap gap-3">
                                    <label
                                        for="profile_photo"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-xl cursor-pointer hover:bg-primary-700 active:scale-95 transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        Pilih Foto
                                    </label>

                                    @if($user->photo)
                                        <button
                                            type="button"
                                            onclick="removePhoto()"
                                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-50 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 active:scale-95 transition border border-red-100"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus Foto
                                        </button>
                                    @endif
                                </div>

                                @error('photo')
                                    <p class="text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror

                                <div class="pt-2">
                                    <button
                                        type="submit"
                                        class="px-6 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-xl hover:bg-primary-700 active:scale-95 transition shadow-sm"
                                    >
                                        Simpan Foto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFORMASI PROFILE --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1 h-6 bg-primary-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Profile</h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- UPDATE PASSWORD --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1 h-6 bg-primary-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-900">Update Password</h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- HAPUS AKUN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-red-100">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1 h-6 bg-red-500 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-red-600">Hapus Akun</h3>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (!file.type.match(/^image\/(jpeg|jpg|png)$/)) {
            alert('Format tidak didukung. Gunakan JPG atau PNG.');
            event.target.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file melebihi 2MB. Pilih file yang lebih kecil.');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            const preview     = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-preview-placeholder');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    function removePhoto() {
        if (!confirm('Yakin ingin menghapus foto profile?')) return;
        document.getElementById('remove-photo').value = '1';
        document.getElementById('photo-form').submit();
    }
    </script>
    @endpush
</x-app-layout>