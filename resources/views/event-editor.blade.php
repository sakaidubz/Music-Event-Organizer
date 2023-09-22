<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Editor') }}
        </h2>
    </x-slot>
    
    <main class="m-4 rounded-lg bg-white shadow p-6">
        <div class="event-list mb-6">
            <h2 class="text-2xl font-bold mb-4">参加中のイベント</h2>

            @foreach($events as $event)
                <div>
                    <a href="{{ route('event-editor.edit', $event->id) }}">{{ $event->name }}</a>
                </div>
            @endforeach
        </div>
    </main>
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>
