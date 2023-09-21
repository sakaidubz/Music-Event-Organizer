<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
        Home
    </x-slot>
    
    <main>
        <div class="event-info">
            <h2>イベント情報</h2>
            <p>イベント名</p>
            <p>日付</p>
            <p>開始日</p>
            <p>時間</p>
            <p>終了日</p>
            <p>時間</p>
            <p>開催場所</p>
            <p>会場名</p>
            <p>住所</p>
        </div>
        <div>
            <h2>タイムライン</h2>
            <p>2023-10-01 13:00 AさんがXXXしました。</p>
            <p>2023-10-01 08:00 BさんがXXXしました。</p>
        </div>
        <div>
            <h2>To Do</h2>
            <p>・イベント会場決定</p>
            <p>・担当者へ連絡</p>
            <p>・出演者決定</p>
            <p>・チケット発売</p>
        </div>
    </main>
    
    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app-layout>