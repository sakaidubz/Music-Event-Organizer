<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Plan') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5 ml-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="container mx-auto my-4 p-4 bg-white rounded shadow">
        <form action="{{ route('add-plan.store') }}" method="post">
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
                <label class="block mb-2 font-semibold text-lg">日付</label>
                <input type="date" name="date" class="w-auto p-2 border border-gray-400 rounded" required />
            </div>
            <div class='mb-4'>
                <label class="block mb-2 font-semibold text-lg">内容</label>
                <input type="text" name="description" class="w-3/4 p-2 border border-gray-400 rounded" required />
            </div>
            <input type="submit" value="Add Plan" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition">
        </form>
        
        <div class="plans p-4 mt-4 border border-t border-gray-300">
            <h3 class="text-lg font-semibold mb-2">Current Plans</h3>
            <ul>
                @foreach($plans as $plan)
                    <li class="mb-1">{{ $plan->date }}: {{ $plan->description }} [created at {{ $plan->created_at }}]</li>
                @endforeach
            </ul>
        </div>
    </div>
        
    <x-slot name="footer">
        <x-footer />
    </x-slot>

</x-app-layout>