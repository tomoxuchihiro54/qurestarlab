@extends('layouts.default')

@section('title', '平成28年度短答式問題（憲法）| 解答結果')

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
  <div class="col-sm-12 col-xs-12">
    <div class="ly-graph-area">
      <canvas id="line_graph" height="200" width="400"></canvas>
      <div class="col-sm-12 col-xs-12">
        <a href="{{ url('/dashboard') }}" class="btn btn-success btn-block ly-btn-q">ダッシュボードへ</a>
      </div>
    </div>
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
@section('jq_area')
<script>
//折れ線グラフ
var ctx = document.getElementById("line_graph");
var myLineChart = new Chart(ctx, {
  //グラフの種類
  type: 'line',
  //データの設定
  data: {
      //データ項目のラベル
      labels: [
      <?php $length = count($u_answers); ?>
      <?php $no = 0 ?>
      @foreach($u_answers as $u_ans)
        '第{{ $u_ans->num_times }}回'
        <?php $no++ ?>
        {{ $no != $length ? ',' : '' }}
      @endforeach
      ],
      //データセット
      datasets: [{
          //凡例
          label: "得点推移",
          //背景色
          backgroundColor: "rgba(75,192,192,0.4)",
          //枠線の色
          borderColor: "rgba(75,192,192,1)",
          //グラフのデータ
          data: [
            <?php $length = count($u_total_points); ?>
            <?php $no = 0 ?>
            @foreach($u_total_points as $u_total_point)
              '{{ $u_total_point->total_point }}'
              <?php $no++ ?>
              {{$no != $length ? ',' : '' }}
            @endforeach
          ]
      }]
  },
  //オプションの設定
  options: {
      responsive: true,
      scales: {
          //縦軸の設定
          yAxes: [{
              ticks: {
                  //最小値を0にする
                  beginAtZero: true,
                  min: 0,
                  max: 10
              }
          }]
      }
  }
});
</script>
@endsection