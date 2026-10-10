<x-sidebar>
    @isset($header)
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                {{ $header }}
            </div>
        </div>
    @endisset

    <div>
        {{ $slot }}
    </div>
</x-sidebar>