<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight">
            Edit Kegiatan
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-5 md:p-8">
                    
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="font-semibold text-red-800 mb-2 text-sm md:text-base">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-xs md:text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('agenda.update', $agenda) }}" method="POST" class="space-y-5 md:space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Nama Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nama_kegiatan" 
                                id="nama_kegiatan"
                                value="{{ old('nama_kegiatan', $agenda->nama_kegiatan) }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                                required
                            >
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Deskripsi
                            </label>
                            <textarea 
                                name="deskripsi" 
                                id="deskripsi"
                                rows="4"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 resize-none"
                            >{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="tanggal_mulai" 
                                    id="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', $agenda->tanggal_mulai->format('Y-m-d')) }}"
                                    class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                                    required
                                >
                            </div>

                            <div>
                                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                    Tanggal Selesai
                                </label>
                                <input 
                                    type="date" 
                                    name="tanggal_selesai" 
                                    id="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', $agenda->tanggal_selesai?->format('Y-m-d')) }}"
                                    class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                    Waktu Mulai
                                </label>
                                <input 
                                    type="time" 
                                    name="waktu_mulai" 
                                    id="waktu_mulai"
                                    value="{{ old('waktu_mulai', $agenda->waktu_mulai) }}"
                                    class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                                >
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                    Waktu Selesai
                                </label>
                                <input 
                                    type="time" 
                                    name="waktu_selesai" 
                                    id="waktu_selesai"
                                    value="{{ old('waktu_selesai', $agenda->waktu_selesai) }}"
                                    class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Lokasi
                            </label>
                            <input 
                                type="text" 
                                name="lokasi" 
                                id="lokasi"
                                value="{{ old('lokasi', $agenda->lokasi) }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                            >
                        </div>

                        <div>
                            <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Divisi
                            </label>
                            <input 
                                type="text" 
                                name="divisi" 
                                id="divisi"
                                value="{{ old('divisi', $agenda->divisi) }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3"
                                list="divisi-list"
                            >
                            <datalist id="divisi-list">
                                <option value="Divisi PSDA">
                                <option value="Divisi Pendidikan">
                                <option value="Divisi Jasroh">
                                <option value="Divisi Kewirausahaan">
                                <option value="Divisi Minat Bakat">
                                <option value="Pengurus Inti">
                            </datalist>
                        </div>

                        <div>
                            <label for="panitia_emails" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Email/Nama Panitia (Pisahkan dengan koma)
                            </label>
                            <textarea 
                                name="panitia_emails" 
                                id="panitia_emails"
                                rows="3"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 resize-none"
                            >{{ old('panitia_emails', $agenda->getPanitiaEmailsString()) }}</textarea>
                            <p class="mt-1 text-[10px] md:text-xs text-gray-500">Email akan digunakan untuk mengirim notifikasi kegiatan</p>
                        </div>

                        <div class="bg-primary-50 border border-primary-200 rounded-lg p-3 md:p-4">
                            <div class="flex items-start">
                                <input 
                                    type="checkbox" 
                                    name="is_public" 
                                    id="is_public"
                                    value="1"
                                    {{ old('is_public', $agenda->is_public) ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1 md:mt-0.5"
                                >
                                <div class="ml-3">
                                    <label for="is_public" class="font-semibold text-sm md:text-base text-gray-900 block mb-0.5">
                                        Jadikan kegiatan ini publik
                                    </label>
                                    <p class="text-xs md:text-sm text-gray-600">
                                        Kegiatan publik dapat dilihat oleh semua mahasiswa.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between pt-6 border-t border-gray-200 gap-3 md:gap-4">
                            <a href="{{ route('agenda.index') }}" class="w-full sm:w-auto text-center px-6 py-2.5 md:py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                                ← Kembali
                            </a>
                            <button 
                                type="submit"
                                class="w-full sm:w-auto flex justify-center items-center px-6 py-2.5 md:py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg"
                            >
                                Update Kegiatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>