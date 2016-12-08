@extends('layouts.default')

@section('title', 'ダッシュボード')

@section('header_nav')

<!-- ヘッダー -start -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      @if (Auth::guest())
      <a class="navbar-brand" href="{{ url('/') }}">
      @else
      <a class="navbar-brand" href="{{ url('/dashboard') }}">
      @endif
          <img class="ly-top-logo" src="/images/qrestarLab-logo.png">
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
        &nbsp;
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}">ログイン</a></li>
          <li><a href="{{ url('/register') }}">新規登録</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                  ログアウト
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- ヘッダー -end -->
@endsection

@section('content')
<div class="container">
  <div class="ly-dashboard-area">
    <!-- ▼解答結果▼ -->
    <div class="col-sm-6 col-xs-6 ly-ans-block">
      <a href="{{ url('/dashboard/answer_history') }}">
        <img class="ly-db-img" src="/images/d-graph.png">
        <p class="text-center">解答結果</p>
      </a>
    </div>
    <!-- ▼解答結果▼ -->
    <!-- ▼成長率▼ -->
    <div class="col-sm-6 col-xs-6 ly-trands-block">
    <a href="{{ url('/dashboard/result_trands') }}">
      <img class="ly-db-img" src="/images/d-line-graph.png">
      <p class="text-center">成績推移</p>
    </a>
    </div>
    <!-- ▲成長率▲ -->
  </div>
  <div class="col-sm-12 col-xs-12">
    <a href="{{ url('/question') }}" class="btn btn-success btn-block ly-btn-q">問題ページへ</a>
  </div>
</div>
@endsection
@section('footer')
<footer>
  <div class="footer_in">
    <div class="copyright">
        Copyright&copy;Tomohiro Horiuchi All Right Reserved.
    </div>
  </div>
</footer>
@endsection