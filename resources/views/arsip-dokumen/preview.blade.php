<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight truncate">
                {{ $arsipDokumen->judul }}
            </h2>
            <a href="{{ route('arsip-dokumen.download', $arsipDokumen) }}"
                class="flex-none ml-3 px-3 py-1.5 md:px-4 md:py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 text-xs md:text-sm shadow-sm transition"
            >
                Download
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('arsip-dokumen.index') }}" class="text-sm text-primary-600 hover:underline">← Kembali ke Arsip Dokumen</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" style="height: 80vh;">
                @if(strtolower($arsipDokumen->file_type) === 'pdf')
                    <iframe src="{{ asset('storage/'.$arsipDokumen->file_path) }}"
                        class="w-full h-full"
                        title="{{ $arsipDokumen->judul }}"
                    ></iframe>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                        <img src="{{ asset('storage/'.$arsipDokumen->file_path) }}"
                            alt="{{ $arsipDokumen->judul }}"
                            class="max-w-full max-h-full object-contain"
                        >
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>