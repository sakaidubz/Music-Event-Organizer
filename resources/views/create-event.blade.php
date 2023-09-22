<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>
    
    <main class="m-4 rounded-lg bg-white shadow p-6">
        <div class="event-info mb-6">
            <h2 class="text-2xl font-bold mb-4">イベント情報</h2>
            <form action="/create-event" method="post" onsubmit="return confirmSubmit();">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">イベント名</label>
                    <input type="text" name="event[name]" placeholder="イベント名" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="mb-4">
                    <p class="font-semibold mb-2">日付</p>
                    <label class="block mb-2 font-semibold">開始日</label>
                    <input type="date" name="event[start_date]" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" placeholder="20--/--/--" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">時間</label>
                    <input type="time" name="event[start_time]" placeholder="--:--" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">終了日</label>
                    <input type="date" name="event[end_date]" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" placeholder="20--/--/--" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">時間</label>
                    <input type="time" name="event[end_time]" placeholder="--:--" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="mb-4">
                    <p class="font-semibold mb-2">開催場所</p>
                    <label class="block mb-2 font-semibold">会場名</label>
                    <input type="text" name="event[venue]" placeholder="Circus Tokyo" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">住所</label>
                    <input type="text" name="event[address]" placeholder="東京都渋谷区渋谷３丁目２６−１６ 第５叶ビル 1F/B1F" class="w-full p-2 border border-gray-400 rounded" />
                </div>
                <input type="submit" value="Create Event" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition">
            </form>
        </div>
    </main>
    
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
