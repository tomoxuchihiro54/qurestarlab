<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="/base/css/styles.min.css" rel="stylesheet">
        <link href="/base/css/font-awesome.min.css" rel="stylesheet">
        <link href="/css/layouts.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/base/js/utility.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    </head>
  <body>
    <!--ナビゲーションバー -start -->
    @yield('header_nav')
    <!--ナビゲーションバー -end -->
    @if (session('flash_message'))
    <!-- フラッシュメッセージ -start -->
    <div class="flash_message">
        {{ session('flash_message') }}
    </div>
    <!-- フラッシュメッセージ -end -->
    @endif
    <!-- メインコンテンツ -start-->
    <div class="container">
        @foreach($errors->all() as $error)
        <div class="error">{{ $error }}</div>
        @endforeach
        @yield('content')
    </div>
    <!-- メインコンテンツ -end-->
    @yield('jq_area')
  </body>
</html>