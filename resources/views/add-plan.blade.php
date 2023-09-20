<x-app-layout>
    <x-slot name="header">
        Add Plan
    </x-slot>
    <body>
        <main>
            
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