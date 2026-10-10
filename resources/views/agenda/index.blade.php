<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight text-left">
                Agenda & Jadwal Kegiatan
            </h2>
            @if(auth()->check() && auth()->user()->isPengurus())
                <a href="{{ route('agenda.create') }}" class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 text-[10px] md:text-sm shadow-sm transition">
                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Kegiatan
                </a>
            @endif
        </div>
    </x-slot>

    <style>
        @media (max-width: 768px) {
            .fc .fc-toolbar.fc-header-toolbar {
                display: flex;
                flex-direction: column;
                gap: 12px;
                align-items: center;
                margin-bottom: 1em !important;
            }
            .fc .fc-toolbar-title {
                font-size: 1.25rem !important;
                text-align: center;
            }
            .fc .fc-button {
                padding: 0.3em 0.6em !important;
                font-size: 0.75rem !important;
            }
            .fc-toolbar-chunk {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 4px;
            }
        }
    </style>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm md:text-base">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6 p-3 md:p-5 flex items-center overflow-x-auto">
                <form method="GET" action="{{ route('agenda.index') }}" class="flex flex-row items-end gap-2 md:gap-4 w-full min-w-min">
                    
                    <div class="flex-1 min-w-[100px]">
                        <label class="block text-[9px] md:text-xs font-medium text-gray-500 uppercase mb-1">Bulan</label>
                        <select name="bulan" class="w-full text-[10px] md:text-sm rounded-lg border-gray-300 py-1.5 px-2 md:py-2.5 md:px-3 focus:ring-primary-500 focus:border-primary-500 bg-white">
                            <option value="">Semua Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="flex-1 min-w-[100px]">
                        <label class="block text-[9px] md:text-xs font-medium text-gray-500 uppercase mb-1">Divisi</label>
                        <select name="divisi" class="w-full text-[10px] md:text-sm rounded-lg border-gray-300 py-1.5 px-2 md:py-2.5 md:px-3 focus:ring-primary-500 focus:border-primary-500 bg-white">
                            <option value="">Semua Divisi</option>
                            @foreach($divisis as $divisi)
                                <option value="{{ $divisi }}" {{ request('divisi') == $divisi ? 'selected' : '' }}>
                                    {{ $divisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-none gap-1.5 md:gap-2">
                        <button type="submit" class="px-3 py-1.5 md:px-4 md:py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 text-[10px] md:text-sm transition whitespace-nowrap">
                            Filter
                        </button>
                        <a href="{{ route('agenda.index') }}" class="flex items-center justify-center px-3 py-1.5 md:px-4 md:py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 text-[10px] md:text-sm transition border border-gray-200 whitespace-nowrap">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6 p-2 flex justify-center md:justify-start gap-2">
                <button onclick="showCalendar()" id="btn-calendar" class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm md:text-base font-medium transition shadow-sm w-1/2 md:w-auto">
                    📅 Kalender
                </button>
                <button onclick="showList()" id="btn-list" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm md:text-base font-medium transition hover:bg-gray-200 w-1/2 md:w-auto">
                    🗂️ Grid Daftar
                </button>
            </div>

            <div id="calendar-view" class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-4 md:p-6 text-xs md:text-sm w-full">
                <div id="calendar"></div>
            </div>

            <div id="list-view" class="hidden">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                    @forelse($agenda as $item)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 p-3 md:p-5 flex flex-col h-full">
                            
                            <div class="flex flex-wrap gap-1 mb-2">
                                @if($item->is_public)
                                    <span class="px-1.5 py-0.5 bg-green-100 text-green-700 rounded text-[9px] md:text-[10px] font-bold border border-green-200">✓ Publik</span>
                                @else
                                    <span class="px-1.5 py-0.5 bg-blue-100 text-blue-700 rounded text-[9px] md:text-[10px] font-bold border border-blue-200">🔒 Internal</span>
                                @endif
                                @if($item->divisi)
                                    <span class="px-1.5 py-0.5 bg-purple-100 text-purple-700 rounded text-[9px] md:text-[10px] font-bold border border-purple-200 truncate max-w-[80px] md:max-w-[120px]">{{ $item->divisi }}</span>
                                @endif
                            </div>

                            <h3 class="font-bold text-gray-900 mb-2 truncate text-xs md:text-base" title="{{ $item->nama_kegiatan }}">{{ $item->nama_kegiatan }}</h3>
                            
                            <div class="space-y-1.5 text-[10px] md:text-sm text-gray-600 mb-4 flex-grow">
                                <p class="flex items-start">
                                    <span class="mr-1 md:mr-1.5">📅</span>
                                    <span>
                                        {{ $item->tanggal_mulai->format('d/m/Y') }}
                                        @if($item->tanggal_selesai && !$item->tanggal_mulai->isSameDay($item->tanggal_selesai))
                                            - {{ $item->tanggal_selesai->format('d/m/Y') }}
                                        @endif
                                    </span>
                                </p>
                                @if($item->waktu_mulai)
                                    <p class="flex items-start">
                                        <span class="mr-1 md:mr-1.5">⏰</span> 
                                        <span>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }} @if($item->waktu_selesai) - {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }} @endif</span>
                                    </p>
                                @endif
                                @if($item->lokasi)
                                    <p class="flex items-start">
                                        <span class="mr-1 md:mr-1.5">📍</span> 
                                        <span class="truncate" title="{{ $item->lokasi }}">{{ $item->lokasi }}</span>
                                    </p>
                                @endif
                            </div>

                            @if(auth()->check() && auth()->user()->isPengurus())
                                <div class="flex flex-col sm:flex-row gap-1.5 mt-auto pt-3 border-t border-gray-100">
                                    <a href="{{ route('agenda.edit', $item) }}" class="flex-1 flex justify-center items-center px-2 py-1.5 md:py-2 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 text-[10px] md:text-xs transition">
                                        <svg class="w-3 h-3 md:w-3.5 md:h-3.5 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    
                                    @if(auth()->user()->isInti())
                                        <form action="{{ route('agenda.destroy', $item) }}" method="POST" class="inline flex-1" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex justify-center items-center px-2 py-1.5 md:py-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-medium rounded-md text-[10px] md:text-xs transition border border-red-100 hover:border-transparent">
                                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                <span class="hidden sm:inline">Hapus</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-2 md:col-span-3 lg:col-span-4 text-center py-12 md:py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-gray-50 rounded-full mb-3 md:mb-4">
                                <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="text-sm md:text-lg font-semibold text-gray-900 mb-1 md:mb-2">Belum Ada Kegiatan</h3>
                            <p class="text-xs md:text-sm text-gray-500">Belum ada agenda kegiatan yang tersedia saat ini</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div id="event-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-5 md:p-6">
                    <div class="flex justify-between items-start mb-4 border-b pb-3">
                        <h3 id="modal-title" class="text-base md:text-lg font-bold text-gray-900 pr-4"></h3>
                        <button onclick="closeEventModal()" class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div id="modal-content" class="space-y-2.5 text-xs md:text-sm text-gray-700"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    
    <script>
        function showCalendar() {
            document.getElementById('calendar-view').classList.remove('hidden');
            document.getElementById('list-view').classList.add('hidden');
            document.getElementById('btn-calendar').classList.replace('bg-gray-100', 'bg-primary-600');
            document.getElementById('btn-calendar').classList.replace('text-gray-700', 'text-white');
            document.getElementById('btn-list').classList.replace('bg-primary-600', 'bg-gray-100');
            document.getElementById('btn-list').classList.replace('text-white', 'text-gray-700');
        }

        function showList() {
            document.getElementById('calendar-view').classList.add('hidden');
            document.getElementById('list-view').classList.remove('hidden');
            document.getElementById('btn-list').classList.replace('bg-gray-100', 'bg-primary-600');
            document.getElementById('btn-list').classList.replace('text-gray-700', 'text-white');
            document.getElementById('btn-calendar').classList.replace('bg-primary-600', 'bg-gray-100');
            document.getElementById('btn-calendar').classList.replace('text-white', 'text-gray-700');
        }

        function closeEventModal() {
            document.getElementById('event-modal').classList.add('hidden');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('event-modal');
            if (event.target === modal) {
                closeEventModal();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var events = @json($events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek' // <-- MINGGU (timeGridWeek) DITAMBAHKAN KEMBALI
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu', // <-- TEKS MINGGU DITAMBAHKAN KEMBALI
                    list: 'List'
                },
                events: events,
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    
                    const event = info.event;
                    const props = event.extendedProps;
                    
                    document.getElementById('modal-title').textContent = event.title;
                    
                    let content = '';
                    content += '<p class="flex items-start"><span class="mr-2">📅</span><span><strong>Mulai:</strong> ' + event.start.toLocaleDateString('id-ID') + '</span></p>';
                    
                    if (event.end) {
                        content += '<p class="flex items-start"><span class="mr-2">🏁</span><span><strong>Sampai:</strong> ' + event.end.toLocaleDateString('id-ID') + '</span></p>';
                    }
                    if (props.lokasi) {
                        content += '<p class="flex items-start"><span class="mr-2">📍</span><span><strong>Lokasi:</strong> ' + props.lokasi + '</span></p>';
                    }
                    if (props.divisi) {
                        content += '<p class="flex items-start"><span class="mr-2">👥</span><span><strong>Divisi:</strong> ' + props.divisi + '</span></p>';
                    }
                    if (props.deskripsi) {
                        content += '<div class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-100">' + props.deskripsi + '</div>';
                    }
                    
                    content += '<p class="mt-4"><span class="px-2.5 py-1 rounded-full text-[10px] md:text-xs font-bold ' + 
                        (props.is_public ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-blue-100 text-blue-700 border border-blue-200') + '">' +
                        (props.is_public ? '✓ Publik' : '🔒 Internal') + '</span></p>';
                    
                    document.getElementById('modal-content').innerHTML = content;
                    document.getElementById('event-modal').classList.remove('hidden');
                },
                height: 'auto',
                windowResize: function(arg) {
                    if (window.innerWidth < 768) {
                        // Jika ingin mobile otomatis List, biarkan ini. 
                        // Tapi karena user bisa klik "Minggu" sekarang, 
                        // Anda juga bisa menghapus block windowResize ini jika 
                        // tidak ingin dipaksa kembali ke ListWeek setiap ada perubahan ukuran layar.
                    }
                }
            });

            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>