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
<!-- ▼main_img▼ -->
<div class="main_img cover">
  <div class="container main_img_in">
    <div class="ly-content-in">
      <div class="caption">
        <h2>日々の学習を記録しよう</h2>
        <p><strong>法律資格試験</strong>は１年１回！合格を勝ち取るために、日々の学習状況を記録・視覚化して、弱点を発見しよう！</p>
      </div>
      <div class="sign_up_btn">
          <a href=""class="btn btn-primary btn-lg"><i class="fa fa-pencil" aria-hidden="true"></i>新規登録</a>
      </div>
    </div>
  </div>
</div>
<!-- ▲main_img▲ -->
<!-- ▼ container -->
<div class="wrapper">
  <div class="container">
    <div class="three_points">
      <h2>QrestarLabとは？</h2>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="content_block">
          <img src="/images/study.png">
          <h3>問題学習の記録</h3>
          <p>資格試験の過去問を解くことで、知識整理をし、
            1問当たりにかかる時間を計測することで、
            時間の限られた本番の試験への対応力を養うことができます</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="content_block">
          <img src="/images/pie.png">
          <h3>正答率の視覚化</h3>
          <p>問題演習の結果を記録することで、正答率をグラフ化し
            問題に対する自分のステータスを確認できます</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="content_block">
          <img src="/images/line-graph.png">
          <h3>成績推移の視覚化</h3>
          <p>問題に対する、得点の推移を視覚的に確認することで、合格までにやるべきことを把握できます</p>
        </div>
      </div>
    </div>
    <!-- ▲ container - end -->
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