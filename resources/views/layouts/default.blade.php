<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>
        <link href="/base/css/styles.min.css" rel="stylesheet">
        <link href="/base/css/font-awesome.min.css" rel="stylesheet">
        <link href="/css/layouts.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/base/js/utility.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script src="/js/jquery.pjax.js"></script>
        <script src="/js/jquery.serialize-hash.js"></script>
        @yield('include_script')
    </head>
  @if (isset($add_class))
  <body class="{{ $add_class }}">
  @else
  <body class="ly-main-page">
  @endif
    <!--ナビゲーションバー -start -->
    @yield('header_nav')
    <!--ナビゲーションバー -end -->
    @yield('content')
    <!-- メインコンテンツ -end-->
    @yield('footer')
    @yield('jq_area')
  <script src="/js/question.pjax.js"></script>
  </body>
</html>