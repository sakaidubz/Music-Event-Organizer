<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>
    
    <main>
        <div class="event-info">
            <h2>イベント情報</h2>
            <form action="" method="post">
                @csrf
                <div class="event-name">
                    <label>イベント名</label>
                    <input type="text" name="event[name]" placeholder="イベント名" />
                </div>
                <div class="Date">
                    <p>日付</p>
                    <label>開始日</label>
                    <input type="date" name="event[start_date]" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" placeholder="20--/--/--">
                </div>
                <div class="">
                    <label>時間</label>
                    <input type="time" name="event[start_time]" placeholder="--:--" />
                </div>
                <div class="">
                    <label>終了日</label>
                    <input type="date" name="event[start_date]" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" placeholder="20--/--/--">
                </div>
                <div class="">
                    <label>時間</label>
                    <input type="time" name="event[]" placeholder="--:--" />
                </div>
                <div class="">
                    <p>開催場所</p>
                    <label>会場名</label>
                    <input type="text" name="event[name]" placeholder="Circus Tokyo" />
                </div>
                <div class="">
                    <label>住所</label>
                    <input type="text" name="event[name]" placeholder="東京都渋谷区渋谷３丁目２６−１６ 第５叶ビル 1F/B1F" />
                </div>
                <input type="submit" value="Create Event" />
            </form>
        </div>
    </main>
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>