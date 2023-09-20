<x-app-layout>
    <x-slot name="header">
        Home
    </x-slot>
    <body>
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
        
        <footer>
            <h2>お問い合わせ</h2>
            <p>Email:sakai@example.com</p>
            <button id="scrollToTop" onclick="scrollToTop()">Top</button>
        </footer>
        
        <script>
            // ページのトップにスクロールする関数
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // スムーズなスクロール効果を提供
                });
            }
        </script>
    </body>
</x-app-layout>