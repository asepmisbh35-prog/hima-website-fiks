<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Total User</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Pengurus Inti</p>
                            <p class="text-xl md:text-2xl font-bold text-purple-600">{{ $stats['pengurus_inti'] }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Pengurus Harian</p>
                            <p class="text-xl md:text-2xl font-bold text-green-600">{{ $stats['pengurus_harian'] }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Mahasiswa</p>
                            <p class="text-xl md:text-2xl font-bold text-blue-600">{{ $stats['mahasiswa'] }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <form method="GET" action="{{ route('users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari nama atau email..." 
                            value="{{ request('search') }}"
                            class="w-full rounded-lg border-gray-300"
                        >
                    </div>
                    <div>
                        <select name="role" class="w-full rounded-lg border-gray-300">
                            <option value="">Semua Role</option>
                            <option value="mahasiswa_umum" {{ request('role') == 'mahasiswa_umum' ? 'selected' : '' }}>Mahasiswa Umum</option>
                            <option value="pengurus_harian" {{ request('role') == 'pengurus_harian' ? 'selected' : '' }}>Pengurus Harian</option>
                            <option value="pengurus_inti" {{ request('role') == 'pengurus_inti' ? 'selected' : '' }}>Pengurus Inti</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                            Filter
                        </button>
                        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-xl sm:rounded-2xl">
                <div class="p-4 md:p-6">
                    
                    <div id="desktop-user-table" class="overflow-x-auto" style="display: none;">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Bergabung</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-5 w-80">
                                            <div class="flex items-center gap-3">
                                                <div class="flex-shrink-0">
                                                    @if($user->photo)
                                                        <img src="{{ asset('storage/' . $user->photo) }}?v={{ time() }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-xl object-cover shadow-md ring-2 ring-primary-100" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                        <div class="hidden w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                    @else
                                                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</div>
                                                    @if($user->nim)
                                                        <div class="text-xs text-gray-500 truncate">NIM: {{ $user->nim }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                </svg>
                                                <span class="text-sm text-gray-900">{{ $user->email }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            @php
                                                $roleConfig = [
                                                    'mahasiswa_umum' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'icon' => '👤'],
                                                    'pengurus_harian' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => '⭐'],
                                                    'pengurus_inti' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'border' => 'border-purple-200', 'icon' => '👑'],
                                                ];
                                                $config = $roleConfig[$user->role];
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                                <span class="mr-1.5">{{ $config['icon'] }}</span>
                                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <button onclick="openModal({{ $user->id }})" class="inline-flex items-center px-3 py-1.5 bg-primary-600 text-white text-xs font-medium rounded-lg hover:bg-primary-700 transition shadow-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                    Ubah Role
                                                </button>
                                                @if($user->id !== auth()->id())
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan!')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition shadow-sm">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Akun Anda</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-20 text-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada User</h3>
                                            <p class="text-gray-500">Belum ada user yang terdaftar</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div id="mobile-user-cards" class="space-y-4" style="display: none;">
                        @forelse($users as $user)
                            <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition">
                                <div class="flex items-center gap-4 mb-4 border-b border-gray-50 pb-4">
                                    <div class="flex-shrink-0">
                                        @if($user->photo)
                                            <img src="{{ asset('storage/' . $user->photo) }}?v={{ time() }}" alt="{{ $user->name }}" class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-primary-100" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="hidden w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-base font-bold text-gray-900 truncate">{{ $user->name }}</h4>
                                        @if($user->nim)
                                            <p class="text-xs font-medium text-gray-500 mb-0.5">NIM: {{ $user->nim }}</p>
                                        @endif
                                        <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-3 mb-4 flex justify-between items-center">
                                    <div>
                                        @php
                                            $roleConfig = [
                                                'mahasiswa_umum' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'icon' => '👤'],
                                                'pengurus_harian' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => '⭐'],
                                                'pengurus_inti' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'border' => 'border-purple-200', 'icon' => '👑'],
                                            ];
                                            $config = $roleConfig[$user->role];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-bold {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                            <span class="mr-1.5">{{ $config['icon'] }}</span>
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] font-medium text-gray-500 flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $user->created_at->format('d M Y') }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <button onclick="openModal({{ $user->id }})" class="flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white text-xs font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm active:scale-95">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Ubah Role
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="w-full" onsubmit="return confirm('Yakin hapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 bg-red-50 text-red-600 border border-red-200 text-xs font-semibold rounded-xl hover:bg-red-100 transition shadow-sm active:scale-95">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex items-center justify-center px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-400 text-xs font-semibold rounded-xl">
                                            Akun Anda
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center shadow-sm">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 mb-1">Tidak Ada User</h3>
                                <p class="text-sm text-gray-500">Belum ada user yang terdaftar</p>
                            </div>
                        @endforelse
                    </div>

                    @if($users->hasPages())
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @foreach($users as $user)
        <div id="modal-{{ $user->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full z-50" onclick="if(event.target === this) closeModal({{ $user->id }})">
            <div class="relative top-20 mx-auto p-4 md:p-8 border-0 w-11/12 md:w-2/5 lg:w-1/3 shadow-2xl rounded-2xl bg-white" onclick="event.stopPropagation()">
                <div class="flex justify-between items-start mb-6 pb-4 border-b-2 border-gray-200">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900">Ubah Role User</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola hak akses pengguna</p>
                    </div>
                    <button onclick="closeModal({{ $user->id }})" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 mb-6">
                    <div class="flex items-center">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}?v={{ time() }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-xl object-cover mr-3 shadow-md ring-2 ring-primary-100" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold text-lg mr-3 shadow-md">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @else
                            <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold text-lg mr-3 shadow-md">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                            <p class="text-sm text-gray-600 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('users.updateRole', $user) }}" method="POST" data-turbo="false">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Role Baru:</label>
                        <div class="space-y-3">
                            <label class="flex items-center p-3 md:p-4 border-2 rounded-xl cursor-pointer transition {{ $user->role == 'mahasiswa_umum' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                                <input type="radio" name="role" value="mahasiswa_umum" {{ $user->role == 'mahasiswa_umum' ? 'checked' : '' }} class="w-5 h-5 text-blue-600">
                                <div class="ml-3">
                                    <div class="font-semibold text-gray-900 text-sm md:text-base">👤 Mahasiswa Umum</div>
                                    <div class="text-xs text-gray-500">Akses terbatas, tidak bisa kelola data</div>
                                </div>
                            </label>

                            <label class="flex items-center p-3 md:p-4 border-2 rounded-xl cursor-pointer transition {{ $user->role == 'pengurus_harian' ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-green-300' }}">
                                <input type="radio" name="role" value="pengurus_harian" {{ $user->role == 'pengurus_harian' ? 'checked' : '' }} class="w-5 h-5 text-green-600">
                                <div class="ml-3">
                                    <div class="font-semibold text-gray-900 text-sm md:text-base">⭐ Pengurus Harian</div>
                                    <div class="text-xs text-gray-500">Kelola aspirasi, pendaftaran, rapat, proker</div>
                                </div>
                            </label>

                            <label class="flex items-center p-3 md:p-4 border-2 rounded-xl cursor-pointer transition {{ $user->role == 'pengurus_inti' ? 'border-purple-500 bg-purple-50' : 'border-gray-200 hover:border-purple-300' }}">
                                <input type="radio" name="role" value="pengurus_inti" {{ $user->role == 'pengurus_inti' ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                <div class="ml-3">
                                    <div class="font-semibold text-gray-900 text-sm md:text-base">👑 Pengurus Inti</div>
                                    <div class="text-xs text-gray-500">Full access + kelola user & periode</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse md:flex-row justify-end md:space-x-3 pt-4 border-t gap-2 md:gap-0">
                        <button type="button" onclick="closeModal({{ $user->id }})" class="w-full md:w-auto px-6 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition text-center">
                            Batal
                        </button>
                        <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-lg hover:from-primary-700 hover:to-primary-800 transition shadow-lg text-center">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        // Modal functions
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }

        // Menutup modal jika klik di area luar
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-opacity-75')) {
                document.querySelectorAll('[id^="modal-"]:not(.hidden)').forEach(modal => {
                    modal.classList.add('hidden');
                });
            }
        }

        // Script untuk mengatur tampilan responsif dengan JS saja
        function adjustResponsiveView() {
            const desktopTable = document.getElementById('desktop-user-table');
            const mobileCards = document.getElementById('mobile-user-cards');
            
            // Cek lebar layar (768px adalah standar md breakpoint)
            if (window.innerWidth >= 768) {
                desktopTable.style.display = 'block';
                mobileCards.style.display = 'none';
            } else {
                desktopTable.style.display = 'none';
                mobileCards.style.display = 'block';
            }
        }

        // Jalankan script saat halaman pertama kali diload
        window.addEventListener('DOMContentLoaded', adjustResponsiveView);
        
        // Jalankan script kembali saat ukuran layar di-resize
        window.addEventListener('resize', adjustResponsiveView);
    </script>
</x-app-layout>