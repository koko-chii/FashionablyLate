<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css') <!-- 各画面固有のCSS用 -->
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">FashionablyLate</a>
      @yield('header-nav') <!-- ログイン/ログアウトボタン用 -->
    </div>
  </header>

  <main>
    @yield('content') <!-- ここに各画面の内容が入る -->
  </main>
</body>
</html>
