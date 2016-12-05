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
  <div class="ly-ans-history-area">
    <div class="col-sm-12 col-xs-12">
      @forelse ($u_answers as $key => $u_ans)
      <div class="panel ly-solving">
        <div class="panel-heading">
          <a href="{{ url('/dashboard/answer_history',$u_ans->id) }}">
            <div class="ly-ans-history-num">
              第{{ $key+=1 }}回
            </div>
              <div class="ly-ans-history-tit">
                平成28年 憲法 短答式問題
              </div>
          </a>
        </div>
      </div>
      @empty
      <div class="ly-not-ans-history">表示できる解答結果がありません</div>
      @endforelse
    </div>
  </div>
  <div class="col-sm-12 col-xs-12">
    <a href="{{ url('/dashboard') }}" class="btn btn-success btn-block ly-btn-q">ダッシュボードへ</a>
  </div>
</div>
@endsection