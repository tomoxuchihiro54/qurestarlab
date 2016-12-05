@extends('layouts.default')

@section('title', 'QrestarLab(クレスターラボ)')

@section('header_nav')
<header>
  <!--ナビゲーションバー -start -->
  <div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
            <a class="navbar-brand" href="#"><img class="ly-top-logo" src="/images/qrestarLab-logo.png"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
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
                          Logout
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
    <!--ナビゲーションバー -end -->
  </div>
</header>
@endsection

@section('content')
<div class="ly-top-container">
  <div class="ly-top-content-in">
    <div class="text-white">
      <h2 class="h2">問題学習の記録をしよう！</h2>
      <h3 class="h3">解いた問題の時間・結果を可視化することで、弱点発見につながります。</h2>
      <ul class="list-inline pd-top-20">
        <li>
          <a class="btn btn-default btn-lg" href="#">新規登録</a>
        </li>
        <li>
          <a class="btn btn-default btn-lg" href="#">ログイン</a>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection