<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-xl font-bold mb-4">Edit Data Landing Page</h1>

        @if($photo->photo_url)
            <img src="{{ $photo->photo_url }}" class="w-40 h-40 object-cover rounded-lg mb-4">
        @endif

        <form action="{{ route('admin.landing-photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold mb-1">Judul / Nama</label>
                <input type="text" name="title" class="w-full border rounded-lg px-3 py-2" value="{{ old('title', $photo->title) }}">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Subjudul / Jabatan / Ikon</label>
                <input type="text" name="subtitle" class="w-full border rounded-lg px-3 py-2" value="{{ old('subtitle', $photo->subtitle) }}">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-lg px-3 py-2" rows="3">{{ old('description', $photo->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">
                    @if(in_array($photo->section, ['divisi_staff','divisi_proker']))
                        Pilih Divisi
                    @else
                        Slug / Link
                    @endif
                </label>
                @if(in_array($photo->section, ['divisi_staff','divisi_proker']))
                    <select name="link" class="w-full border rounded-lg px-3 py-2">
                        @foreach($divisiSlugs as $slugKey => $slugLabel)
                            <option value="{{ $slugKey }}" {{ old('link', $photo->link) === $slugKey ? 'selected' : '' }}>{{ $slugLabel }} ({{ $slugKey }})</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" name="link" class="w-full border rounded-lg px-3 py-2" value="{{ old('link', $photo->link) }}">
                @endif
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Urutan</label>
                <input type="number" name="urutan" class="w-full border rounded-lg px-3 py-2" value="{{ old('urutan', $photo->urutan) }}">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $photo->is_active ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-semibold">Aktif (tampilkan)</label>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Ganti Foto (opsional)</label>
                <input type="file" name="photo" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                @error('photo') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="px-5 py-2 bg-orange-600 text-white rounded-lg font-semibold">Update</button>
        </form>
    </div>
</x-app-layout>
