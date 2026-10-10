<x-app-layout>
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl bg-primary-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/></svg>
                </div>
                <div class="min-w-0">
                    <h2 class="font-bold text-base md:text-xl text-gray-800 leading-tight truncate">Kelola Foto & Konten</h2>
                    <p class="text-xs md:text-sm text-gray-500 truncate">Atur konten halaman depan HIMADIKTI</p>
                </div>
            </div>
            <a href="{{ route('admin.landing-photos.create', ['section' => $activeSection]) }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white rounded-xl hover:bg-primary-700 active:scale-95 transition text-sm font-semibold whitespace-nowrap shadow-sm w-full sm:w-auto">
                <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Konten
            </a>
        </div>
    </x-slot>

    <div class="py-8 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div id="flash-success" class="mb-6 flex items-center gap-2 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm font-medium animate-fadeIn">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
                <script>setTimeout(() => document.getElementById('flash-success')?.remove(), 3500);</script>
            @endif

            {{-- Section tabs --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-1.5 mb-6 -mx-4 px-4 sm:mx-0 sm:px-1.5 overflow-x-auto scrollbar-hide">
                <div class="flex gap-1.5 w-max">
                    @php
                        $sectionIcons = [
                            'about'         => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z',
                            'team_inti'     => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                            'team_divisi'   => 'M12 4.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM5 19v-1a4 4 0 014-4h6a4 4 0 014 4v1',
                            'divisi'        => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                            'prestasi'      => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'divisi_staff'  => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                            'divisi_proker' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                        ];
                        $sectionCounts = \App\Models\LandingPhoto::selectRaw('section, count(*) as c')->groupBy('section')->pluck('c', 'section');
                    @endphp
                    @foreach($sections as $key => $label)
                        @php $isActive = $activeSection === $key; @endphp
                        <a href="{{ route('admin.landing-photos.index', ['section' => $key]) }}"
                           class="group flex items-center gap-1.5 md:gap-2 px-3 py-2 md:px-4 md:py-2.5 rounded-xl text-xs md:text-sm font-semibold transition whitespace-nowrap flex-shrink-0
                                  {{ $isActive ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 flex-shrink-0 {{ $isActive ? 'text-white' : 'text-gray-400 group-hover:text-primary-500' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sectionIcons[$key] ?? 'M4 6h16M4 12h16M4 18h16' }}"/>
                            </svg>
                            <span>{{ $label }}</span>
                            @if(($sectionCounts[$key] ?? 0) > 0)
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full flex-shrink-0 {{ $isActive ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $sectionCounts[$key] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            @if($photos->count() > 1)
                <p class="flex items-center gap-1.5 text-xs text-gray-400 mb-4">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/></svg>
                    Seret kartu untuk mengubah urutan tampil
                </p>
            @endif

            <div id="photo-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5">
                @forelse($photos as $photo)
                    <div class="photo-card group relative bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-200 cursor-grab active:cursor-grabbing"
                         draggable="true" data-id="{{ $photo->id }}">

                        <div class="absolute top-2 left-2 z-10 w-7 h-7 rounded-lg bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <svg class="w-4 h-4 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                        </div>

                        <button type="button"
                                data-toggle-url="{{ route('admin.landing-photos.update', $photo) }}"
                                class="toggle-active absolute top-2 right-2 z-10 text-[10px] font-bold px-2 py-1 rounded-full shadow-sm transition
                                       {{ $photo->is_active ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                            {{ $photo->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>

                        <div class="relative w-full h-40 bg-gray-50 overflow-hidden">
                            @if($photo->photo_url)
                                <img src="{{ $photo->photo_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-50 to-orange-100 flex items-center justify-center text-3xl">
                                    📋
                                </div>
                            @endif
                        </div>

                        <div class="p-3.5">
                            <p class="font-bold text-sm text-gray-800 truncate">{{ $photo->title ?? '-' }}</p>
                            @if($photo->subtitle)
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ $photo->subtitle }}</p>
                            @endif
                            @if($photo->link)
                                <span class="inline-flex items-center gap-1 mt-2 text-[10px] font-semibold text-primary-700 bg-primary-50 px-2 py-1 rounded-full truncate max-w-full">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    <span class="truncate">{{ $divisiSlugs[$photo->link] ?? $photo->link }}</span>
                                </span>
                            @endif

                            <div class="flex gap-2 mt-3 pt-3 border-t border-gray-100">
                                <a href="{{ route('admin.landing-photos.edit', $photo) }}"
                                   class="flex-1 flex items-center justify-center gap-1 py-2 bg-gray-50 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-lg transition">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.landing-photos.destroy', $photo) }}" method="POST"
                                      onsubmit="return confirm('Hapus data ini?')" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="w-full flex items-center justify-center gap-1 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-lg transition">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-primary-50 rounded-full mb-3">
                            <svg class="w-6 h-6 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/></svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-1">Belum Ada Data</h3>
                        <p class="text-xs text-gray-500 mb-4">Tambahkan konten pertama untuk kategori ini</p>
                        <a href="{{ route('admin.landing-photos.create', ['section' => $activeSection]) }}"
                           class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white font-semibold text-xs rounded-xl shadow-sm hover:bg-primary-700 transition">
                            + Tambah Konten
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const grid = document.getElementById('photo-grid');
            let dragged = null;

            // --- Drag & drop reordering ---
            if (grid) {
                grid.querySelectorAll('.photo-card').forEach(card => {
                    card.addEventListener('dragstart', () => {
                        dragged = card;
                        setTimeout(() => card.classList.add('opacity-40'), 0);
                    });
                    card.addEventListener('dragend', () => {
                        card.classList.remove('opacity-40');
                        saveOrder();
                    });
                    card.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        const target = e.currentTarget;
                        if (!dragged || target === dragged) return;
                        const rect = target.getBoundingClientRect();
                        const before = (e.clientX - rect.left) < rect.width / 2;
                        grid.insertBefore(dragged, before ? target : target.nextSibling);
                    });
                });
            }

            function saveOrder() {
                const ids = Array.from(grid.querySelectorAll('.photo-card')).map(c => c.dataset.id);
                fetch('{{ route('admin.landing-photos.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ ids }),
                }).catch(() => {});
            }

            // --- Quick active/inactive toggle ---
            document.querySelectorAll('.toggle-active').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = btn.dataset.toggleUrl;
                    const willActivate = btn.textContent.trim() === 'Nonaktif';
                    const formData = new FormData();
                    formData.append('_method', 'PUT');
                    formData.append('is_active', willActivate ? '1' : '0');

                    fetch(url, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData,
                    }).then(res => {
                        if (res.ok) {
                            btn.textContent = willActivate ? 'Aktif' : 'Nonaktif';
                            btn.classList.toggle('bg-green-500', willActivate);
                            btn.classList.toggle('bg-gray-400', !willActivate);
                        }
                    }).catch(() => {});
                });
            });
        });
    </script>
</x-app-layout>
