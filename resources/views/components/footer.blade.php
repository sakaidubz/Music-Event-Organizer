<footer class="m-4 rounded-lg bg-white shadow">
  <button id="scrollToTop" onclick="scrollToTop()" class="fixed right-4 bottom-4 w-12 h-12 rounded-full bg-white  border border-gray-400 text-black hover:bg-gray-100 transition shadow-md">
      Top
  </button>
  <div class="mx-auto w-full max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
    <span class="text-sm text-black dark:text-black sm:text-center">© 2023 Shunsuke Sakai. All Rights Reserved. </span>
    <ul class="mt-3 flex flex-wrap items-center text-sm font-medium text-black dark:text-black sm:mt-0">
      <li>
        <a href="mailto:sakai.shunsuke.tokyotech@gmail.com?subject=お問い合わせ" class="mr-4 hover:underline md:mr-6">Contact</a>
      </li>
      <li>
        <a href="https://github.com/sakaidubz" class="mr-4 hover:underline md:mr-6">GitHub</a>
      </li>
    </ul>
  </div>
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
