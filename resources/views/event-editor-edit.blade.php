<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Editor') }}
        </h2>
    </x-slot>
    
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5 ml-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5 ml-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="mt-5 ml-4 text-left">
        <a href="{{ route('event-editor') }}" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition">イベント一覧へ戻る</a>
    </div>
    
    <div class="container mx-auto my-4 p-4 bg-white rounded shadow">
        <!-- 現在のイベントデータの表示 -->
        <div class="current-data mb-4 p-4 border border-gray-300 rounded-md bg-gray-50">
            <h3 class="text-lg font-semibold mb-2 border-b-2 pb-2">現在のイベント情報</h3>
            <div class="grid grid-cols-2 gap-2">
                <label class="border-b">イベント名</label>
                <span class="border-b">{{ $event->name }}</span>
        
                <label class="border-b">開始日</label>
                <span class="border-b">{{ $event->start_date }}</span>
        
                <label class="border-b">開始時間</label>
                <span class="border-b">{{ $event->start_time }}</span>
        
                <label class="border-b">終了日</label>
                <span class="border-b">{{ $event->end_date }}</span>
        
                <label class="border-b">終了時間</label>
                <span class="border-b">{{ $event->end_time }}</span>
        
                <label class="border-b">会場</label>
                <span class="border-b">{{ $event->venue }}</span>
        
                <label class="border-b">住所</label>
                <span class="border-b">{{ $event->address }}</span>
                
                <label class="border-b">色</label>
                <div class="border-b" style="display: inline-block;">
                  <span style="display: inline-block; width: 60px; height: 20px; background-color: {{ $event->color }};"></span>
                </div>
            </div>
        </div>


        <main class="m-4 rounded-lg bg-white shadow p-6">
            <div class="event-info mb-6">
                <h2 class="text-2xl font-bold mb-4">イベント情報の編集</h2>
                <form action="{{ route('event-editor.update', $event->id) }}" method="post" onsubmit="return confirmSubmit();">
                    @csrf
                    @method('POST') <!-- UpdateのためのPOSTメソッドを指定 -->
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold text-lg">イベント名</label>
                        <input type="text" name="event[name]" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->name }}" />
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold mb-2 text-lg">日付</p>
                        <label class="block mb-2 font-semibold">開始日</label>
                        <input type="date" name="event[start_date]" min="{{ date('Y-m-d', strtotime('-1 year')) }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->start_date }}" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">時間</label>
                        <input type="time" name="event[start_time]" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->start_time }}" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">終了日</label>
                        <input type="date" name="event[end_date]" min="{{ date('Y-m-d', strtotime('-1 year')) }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->end_date }}" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">時間</label>
                        <input type="time" name="event[end_time]" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->end_time }}" />
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold mb-2 text-lg">開催場所</p>
                        <label class="block mb-2 font-semibold">会場名</label>
                        <input type="text" name="event[venue]" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->venue }}" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">住所</label>
                        <input type="text" name="event[address]" class="w-full p-2 border border-gray-400 rounded" value="{{ $event->address }}" />
                    </div>
                    <div class="mb-4 form-group">
                        @include('components.color-selector')
                    </div>
                    <input type="submit" value="Update Event" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition">
                </form>
                
                <form action="{{ route('event-editor.destroy', $event->id) }}" method="POST" onsubmit="return confirm('本当に削除してよろしいですか？');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete Event" class="bg-red-500 text-white p-2 mt-2 rounded hover:bg-red-600 transition">
                </form>
                
                <p class="block p-4 mb-2 mt-4 font-semibold text-lg border-t border-gray-300">イベントにユーザーを追加する</p>
                <form action="{{ route('event-editor.addUser', $event->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 mt-2 font-semibold">Email</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-400 rounded" placeholder="user@example.com" required />
                    </div>
                    <input type="submit" value="Add User" class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition">
                </form>
                
                <div class="participants p-4 mt-4 border-t border-gray-300">
                    <h3 class="text-lg font-semibold mb-2">参加中のユーザー</h3>
                    <ul>
                        @foreach($participants as $participant)
                            <li class="mb-1">{{ $participant->name }} ({{ $participant->email }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </main>
        
        @include('performers')
        
        {{-- <a href="{{ route('performers.show', ['event_id']) }}" class="btn btn-primary">タイムテーブル</a> --}}
    </div>
    
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>

<script>
    function confirmSubmit() {
        var result = confirm("本当に送信してよろしいですか？");
        return result;
    }
</script>
