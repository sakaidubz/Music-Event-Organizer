<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    
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
        
        <div class="timeline mb-8">
            <h2 class="text-2xl font-semibold">タイムライン</h2>
            <div class="mt-4">
                <p>今後実装予定</p>
            </div>
        </div>
        
        <div class="todo">
            <h2 class="text-2xl font-semibold">To Do</h2>
            <ul class="mt-4 list-disc pl-4">
                <li>今後実装予定</li>
            </ul>
        </div>
    </main>
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>