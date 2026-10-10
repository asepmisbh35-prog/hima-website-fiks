<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-xl font-bold mb-4">Tambah Data Landing Page</h1>

        <form action="{{ route('admin.landing-photos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{ section: '{{ $activeSection }}' }">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-1">Kategori</label>
                <select name="section" x-model="section" class="w-full border rounded-lg px-3 py-2">
                    @foreach($sections as $key => $label)
                        <option value="{{ $key }}" {{ $activeSection === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">
                    <span x-show="section === 'divisi_proker'">Judul Program Kerja</span>
                    <span x-show="section !== 'divisi_proker'">Judul / Nama</span>
                </label>
                <input type="text" name="title" class="w-full border rounded-lg px-3 py-2" value="{{ old('title') }}">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">
                    <span x-show="section === 'divisi_proker'">Ikon (emoji, contoh: 📋)</span>
                    <span x-show="section !== 'divisi_proker'">Subjudul / Jabatan</span>
                </label>
                <input type="text" name="subtitle" class="w-full border rounded-lg px-3 py-2" value="{{ old('subtitle') }}">
            </div>

            <div x-show="section === 'divisi' || section === 'divisi_proker'">
                <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-lg px-3 py-2" rows="3">{{ old('description') }}</textarea>
            </div>

            <div x-show="section === 'divisi' || section === 'divisi_staff' || section === 'divisi_proker'">
                <label class="block text-sm font-semibold mb-1">
                    <span x-show="section === 'divisi'">Slug URL Divisi (contoh: divisi-advokasi)</span>
                    <span x-show="section !== 'divisi'">Pilih Divisi</span>
                </label>
                <select name="link" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih --</option>
                    @foreach($divisiSlugs as $slugKey => $slugLabel)
                        <option value="{{ $slugKey }}" {{ old('link') === $slugKey ? 'selected' : '' }}>{{ $slugLabel }} ({{ $slugKey }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Urutan</label>
                <input type="number" name="urutan" class="w-full border rounded-lg px-3 py-2" value="0">
            </div>

            <div x-show="section !== 'divisi_proker'">
                <label class="block text-sm font-semibold mb-1">Foto</label>
                <input type="file" name="photo" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                @error('photo') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="px-5 py-2 bg-orange-600 text-white rounded-lg font-semibold">Simpan</button>
        </form>
    </div>
</x-app-layout>
