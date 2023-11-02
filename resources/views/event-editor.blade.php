<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Editor') }}
        </h2>
    </x-slot>
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    
    <main class="m-4 rounded-lg bg-white shadow p-6">
        <div class="event-list mb-6">
            <h2 class="text-2xl font-bold mb-4">参加中のイベント</h2>

            @foreach($events as $event)
                <div class="mb-4">
                    <span style="display: inline-block; width: 40px; height: 20px; background-color: {{ $event->color }};"></span>
                    <span class="m-2 text-xl">
                        <a href="{{ route('event-editor.edit', $event->id) }}">{{ $event->name }}</a>
                    </span>
                </div>
            @endforeach
        </div>
    </main>
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>
