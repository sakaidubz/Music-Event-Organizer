<x-app-layout>
    <x-slot name="header">
        My Page
    </x-slot>
    <body>
        <main>
            <div class="Registered-information">
                <h2>登録情報</h2>
                <p>Email:</p>
                <p>sakai@example.com</p>
                <p>User Name:</p>
                <p>Sakai Shunsuke</p>
                <h2>登録情報変更</h2>
                <form action="" method="post">
                    @csrf
                    <div class="email">
                        <label>Email</label>
                        <input type="text" name="user[email]" placeholder="sakai@example.com" />
                    </div>
                    <div class="user-name">
                        <label>User Name</label>
                        <input type="text" name="user[name]" placeholder="Sakai Shunsuke" />
                    </div>
                    <div class="password">
                        <label>パスワード</label>
                        <input type="password" name="user[password]" placeholder="" />
                        <label>パスワード確認</label>
                        <input type="password" name="user[password]" placeholder="" />
                    </div>
                    <input type="submit" value="Update" />
                </form>
            </div>
            <div>
                <h2>イベント</h2>
                <p>あなたの関わっているイベント</p>
                <p>ABC Music Event</p>
                <p>ABC Festival</p>
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