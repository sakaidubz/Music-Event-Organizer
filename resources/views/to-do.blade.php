<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To Do') }}
        </h2>
    </x-slot>
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5 ml-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="container mx-auto my-4 p-4 bg-white rounded shadow">
        <form action="{{ route('to-do.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-semibold text-lg">イベント</label>
                <select name="event_id" class="w-3/4 p-1 border border-gray-400 rounded">
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='mb-4'>
                <label class="block mb-2 font-semibold text-lg">内容</label>
                <input type="text" name="description" class="w-3/4 p-2 border border-gray-400 rounded" required />
            </div>
            <input type="submit" value="Add ToDo" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition">
        </form>
        
        <div class="todos p-4 mt-4 border-t border-gray-300">
            <h3 class="text-lg font-semibold mb-2">ToDoリスト</h3>
            <ul>
                @foreach($events as $event)
                    <div class="event p-2 my-2 border-b border-gray-200">
                        <h3 class="text-md font-semibold text-blue-600">{{ $event->name }}</h3>
                        @if($event->todos->count() > 0)
                            <ul>
                                @foreach($event->todos as $todo)
                                    <li>
                                        <form action="{{ route('to-do.update-status', $todo->id)  }}" method="post" class="flex item-center" id="form-{{ $todo->id }}">
                                            @csrf
                                            <div class="mr-2">
                                                <select name="status" onchange="document.getElementById('form-{{ $todo->id }}').submit();">
                                                    <option value="1" {{ $todo->status ? 'selected' : '' }}>完了</option>
                                                    <option value="0" {{ !$todo->status ? 'selected' : '' }}>未完了</option>
                                                </select>
                                            </div>
                                            <span class="description mr-2">{{ $todo->description }}</span>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>ToDoはありません</p>
                        @endif
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
    
</x-app-layout>
