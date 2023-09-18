<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home | Music-Event-Organizer</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            
        </style>
    </head>
    <body>
        <nav class="navbar">
            <div class="navbar-app-name">
                <h1>Music-Event-Organizer</br>Home</h1>
            </div>
            <div class="navbar-logo">
                <!img src="{{ asset('img/MEO_sample_logo.jpg') }}" alt="Event logo">
            </div>
            <div class="navbar-links">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('to-do') }}">To Do</a></li>
                    <li><a href="{{ route('calender') }}">Calender</a></li>
                    <li><a href="{{ route('guestlist') }}">Guestlist</a></li>
                    <li><a href="{{ route('my-page') }}">My Page</a></li>
                    <li><a href="{{ route('login') }}">Log in</a></li>
                    <li><a href="{{ route('logout') }}">Log out</a></li>
                    <li><a href="{{ route('cost-manager') }}">Cost Manager</a></li>
                    <li><a href="{{ route('create-event') }}">Create Event</a></li>
                    <li><a href="{{ route('event-editor') }}">Event Editor</a></li>
                    <li><a href="{{ route('add-plan') }}">Add Plan</a></li>
                </ul>
            </div>
        </nav>

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
</html>