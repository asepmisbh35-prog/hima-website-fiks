<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Dokumen
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-5 md:p-8">
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-r-lg p-4 shadow-sm">
                            <p class="font-semibold text-red-800 mb-2 text-sm md:text-base">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-xs md:text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($arsipDokumen->versi > 1 || $arsipDokumen->children()->exists())
                        <div class="mb-6 bg-indigo-50 border border-indigo-200 rounded-lg p-3 md:p-4 flex items-center justify-between">
                            <p class="text-xs md:text-sm text-indigo-800">
                                Dokumen ini punya riwayat versi.
                            </p>
                            <a href="{{ route('arsip-dokumen.history', $arsipDokumen) }}" class="text-xs md:text-sm font-semibold text-indigo-700 hover:underline whitespace-nowrap ml-3">
                                Lihat Riwayat Versi →
                            </a>
                        </div>
                    @endif

                    <form action="{{ route('arsip-dokumen.update', $arsipDokumen) }}" method="POST" enctype="multipart/form-data" class="space-y-5 md:space-y-6" data-turbo="false">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Judul Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="judul"
                                id="judul"
                                value="{{ old('judul', $arsipDokumen->judul) }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition"
                                required
                            >
                            @error('judul')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori"
                                id="kategori"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition bg-white"
                                required
                            >
                                @foreach(\App\Models\ArsipDokumen::KATEGORI_LIST as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori', $arsipDokumen->kategori) == $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_dokumen" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Tanggal Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                name="tanggal_dokumen"
                                id="tanggal_dokumen"
                                value="{{ old('tanggal_dokumen', $arsipDokumen->tanggal_dokumen->format('Y-m-d')) }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition"
                                required
                            >
                            @error('tanggal_dokumen')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Deskripsi <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <textarea name="deskripsi"
                                id="deskripsi"
                                rows="3"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition resize-none"
                            >{{ old('deskripsi', $arsipDokumen->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 md:p-4">
                            <p class="text-xs md:text-sm text-gray-700 mb-2">
                                File saat ini: <span class="font-semibold">{{ strtoupper($arsipDokumen->file_type) }}</span>
                                ({{ number_format($arsipDokumen->file_size / 1024, 1) }} KB) — Versi {{ $arsipDokumen->versi }}
                            </p>
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Ganti File <span class="text-gray-400 text-xs">(Opsional — upload untuk buat versi baru, versi lama tetap tersimpan)</span>
                            </label>
                            <input id="file"
                                name="file"
                                type="file"
                                accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png"
                                class="w-full text-xs md:text-sm text-gray-700 file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-primary-50 file:text-primary-700 file:font-medium hover:file:bg-primary-100"
                            >
                            @error('file')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 md:p-4">
                            <div class="flex items-start">
                                <input type="checkbox"
                                    name="is_public"
                                    id="is_public"
                                    value="1"
                                    {{ old('is_public', $arsipDokumen->is_public) ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1 md:mt-0.5"
                                >
                                <div class="ml-3">
                                    <label for="is_public" class="font-semibold text-sm md:text-base text-gray-900 block mb-0.5">
                                        Jadikan dokumen ini publik
                                    </label>
                                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                                        Dokumen publik dapat diakses dan didownload oleh semua mahasiswa. Dokumen private hanya bisa diakses oleh pengurus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between pt-6 border-t border-gray-200 gap-3 md:gap-4">
                            <a href="{{ route('arsip-dokumen.index') }}" class="w-full sm:w-auto text-center px-6 py-2.5 md:py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                                ← Batal
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto flex justify-center items-center px-6 py-2.5 md:py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>