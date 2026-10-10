<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight">
            Edit Surat
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl md:rounded-2xl">
                <div class="p-5 md:p-8">
                    @if($errors->any())
                        <div class="mb-6 border-l-4 border-red-500 bg-red-50 rounded-lg p-4">
                            <p class="font-semibold text-red-800 mb-1.5 md:mb-2 text-sm md:text-base">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-xs md:text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('arsip-surat.update', $arsipSurat) }}" method="POST" enctype="multipart/form-data" class="space-y-5 md:space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label for="nomor_surat" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Nomor Surat <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nomor_surat" 
                                    id="nomor_surat"
                                    value="{{ old('nomor_surat', $arsipSurat->nomor_surat) }}"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4"
                                    required
                                >
                            </div>

                            <div>
                                <label for="jenis_surat" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Jenis Surat <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    name="jenis_surat" 
                                    id="jenis_surat"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4 bg-white"
                                    required
                                >
                                    @foreach($jenisSurat as $jenis)
                                        <option value="{{ $jenis }}" {{ old('jenis_surat', $arsipSurat->jenis_surat) == $jenis ? 'selected' : '' }}>
                                            {{ ucfirst($jenis) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="perihal" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Perihal <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="perihal" 
                                    id="perihal"
                                    value="{{ old('perihal', $arsipSurat->perihal) }}"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4"
                                    required
                                >
                            </div>

                            <div>
                                <label for="tanggal_surat" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Tanggal Surat <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="tanggal_surat" 
                                    id="tanggal_surat"
                                    value="{{ old('tanggal_surat', $arsipSurat->tanggal_surat->format('Y-m-d')) }}"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4"
                                    required
                                >
                            </div>

                            <div>
                                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Kategori
                                </label>
                                <input 
                                    type="text" 
                                    name="kategori" 
                                    id="kategori"
                                    value="{{ old('kategori', $arsipSurat->kategori) }}"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4"
                                >
                            </div>

                            <div>
                                <label for="pengirim" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Pengirim
                                </label>
                                <input 
                                    type="text" 
                                    name="pengirim" 
                                    id="pengirim"
                                    value="{{ old('pengirim', $arsipSurat->pengirim) }}"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4"
                                >
                            </div>

                            <div>
                                <label for="penerima" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Penerima
                                </label>
                                <input 
                                    type="text" 
                                    name="penerima" 
                                    id="penerima"
                                    value="{{ old('penerima', $arsipSurat->penerima) }}"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Deskripsi
                                </label>
                                <textarea 
                                    name="deskripsi" 
                                    id="deskripsi"
                                    rows="3"
                                    class="w-full text-sm md:text-base rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 md:py-3 px-3 md:px-4 resize-none"
                                >{{ old('deskripsi', $arsipSurat->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 md:p-5 mt-4">
                            <label class="block text-xs md:text-sm font-semibold text-gray-500 uppercase mb-1">
                                File Saat Ini
                            </label>
                            <p class="text-sm md:text-base text-gray-800 font-medium mb-3 md:mb-4 truncate">
                                {{ basename($arsipSurat->file_path) }}
                            </p>
                            
                            <label for="file" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                Upload File Baru (Opsional)
                            </label>
                            <input 
                                type="file" 
                                name="file" 
                                id="file"
                                accept=".pdf,.doc,.docx"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition"
                            >
                            <p class="text-[10px] md:text-xs text-gray-500 mt-2">Kosongkan jika tidak ingin mengganti file</p>
                        </div>

                        <div class="bg-purple-50 border border-purple-100 rounded-xl p-4 mt-4">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    name="is_public" 
                                    id="is_public"
                                    value="1"
                                    {{ old('is_public', $arsipSurat->is_public) ? 'checked' : '' }}
                                    class="h-4 w-4 md:w-5 md:h-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                                >
                                <label for="is_public" class="ml-3 block text-sm md:text-base font-semibold text-gray-900 cursor-pointer">
                                    Jadikan surat ini publik
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between pt-6 border-t border-gray-200 gap-3 md:gap-4 mt-6">
                            <a href="{{ route('arsip-surat.index') }}" class="w-full sm:w-auto text-center px-6 py-2.5 md:py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition">
                                ← Kembali
                            </a>
                            <button 
                                type="submit"
                                class="w-full sm:w-auto px-6 md:px-8 py-2.5 md:py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition shadow-lg"
                            >
                                Update Surat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>