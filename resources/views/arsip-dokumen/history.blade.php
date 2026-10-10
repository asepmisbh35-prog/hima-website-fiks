<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Versi — {{ $arsipDokumen->judul }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('arsip-dokumen.index') }}" class="text-sm text-primary-600 hover:underline">← Kembali ke Arsip Dokumen</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
                @foreach($versions as $v)
                    <div class="p-4 md:p-5 flex items-center justify-between gap-3 {{ $v->is_latest ? 'bg-green-50/50' : '' }}">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $v->is_latest ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    Versi {{ $v->versi }} {{ $v->is_latest ? '(Terbaru)' : '' }}
                                </span>
                                <span class="text-[10px] md:text-xs text-gray-400">{{ $v->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <p class="font-semibold text-gray-900 truncate text-sm md:text-base">{{ $v->judul }}</p>
                            <p class="text-xs md:text-sm text-gray-500">
                                {{ strtoupper($v->file_type) }} · {{ number_format($v->file_size / 1024, 1) }} KB
                                · Diupload oleh {{ $v->uploader->name ?? '—' }}
                            </p>
                        </div>
                        <a href="{{ route('arsip-dokumen.download', $v) }}"
                            class="flex-none px-3 py-2 bg-primary-600 text-white text-xs md:text-sm font-medium rounded-lg hover:bg-primary-700 transition"
                        >
                            Download
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>