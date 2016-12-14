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
  @if (session('flash_message'))
  <!-- メッセージ -start -->
  <div class="flash_message">
      {{ session('flash_message') }}
  </div>
  <!-- メッセージ -end -->
  @endif
  @foreach($errors->all() as $error)
  <div class="error">{{ $error }}</div>
  @endforeach
  <div class="col-sm-12 col-xs-12">
    <div class="ly-result-area">
      <div class="total-status">
        <p>全体</p>
        <ul class="list-group">
          <li class="list-group-item">
            <span class="text-left">合計点</span>
            <span class="text-right">{{ $count }}点/{{ $questions->sum('point') }}点</span>
          </li>
          <!-- ▼全体の正答状況▼ -->
          <li class="ly-correct-area list-group-item">
              <span class="ly-title">正解数</span>
              <span class="ly-ans-rate">{{ $correct_num }}問/{{ count($questions) }}問</span>
          </li>
          <li class="text-center list-group-item">
            <!-- ▼正答グラフ情報▼ -->
            <canvas id="result_pie" height="100" width="100"></canvas>
            <!-- ▲正答グラフ情報▲ -->
          </li>
          <!-- ▲全体の正答状況▲ -->
        </ul>
      </div>
      <div class="ly-correct-apiece">
        <ul class="list-group">
          @foreach ($u_ans->userAnswerDetails as $userAnswerDetail)
          <li class="list-group-item ly-result-choice">
            <!-- ▼問題番号▼ -->
            <span class="pull-left">第{{ $userAnswerDetail->question_id }}問</span>
            <!-- ▲問題番号▲ -->
            <!-- ▼正解状況▼ -->
            @if ($userAnswerDetail->correct_flag === 1)
            <span class="text-primary pull-left"><i class="fa fa-circle-o" aria-hidden="true"></i></span>
            @else
            <span class="text-danger pull-left"><i class="fa fa-times" aria-hidden="true"></i></span>
            @endif
            <!-- ▲正解状況▲ -->
            <!-- ▼正解肢▼ -->
            @foreach ($userAnswerDetail->question->questionChoices as $questionChoice)
            @if ($questionChoice->correct_flag === 1)
            <span class="pull-right">正解：{{ $questionChoice->sort }}&emsp;解答：{{ $userAnswerDetail->sort_id }}&emsp;{{ s2h($userAnswerDetail->time) }}</span>
            @endif
            @endforeach
            <!-- ▲正解肢▲ -->
          </li>
          @endforeach
        </ul>
        <div class="ly-re-solve">
          @if (isset($data))
          <a href="{{ url('/question') }}" class="btn btn-default btn-block ly-btn-q">再び解く</a>
          @else
          <a href="{{ url('/dashboard/answer_history') }}" class="btn btn-default btn-block ly-btn-q">一覧へ戻る</a>
          @endif
        </div>
        <div class="ly-next-link">
          <a href="{{ url('/dashboard') }}" class="btn btn-success btn-block ly-btn-q">次へ</a>
        </div>
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
//円グラフ（パイ型）
var ctx = document.getElementById("result_pie");
var myPieChart = new Chart(ctx, {
  //グラフの種類
  type: 'pie',
  //データの設定
  data: {
      //データ項目のラベル
      labels: ['正解{{ $u_ans_rate }}%', '不正解{{ 100-$u_ans_rate }}%'],
      //データセット
      datasets: [{
          //背景色
          backgroundColor: [
              "#5add5a",
              "#f08080"
          ],
          //グラフのデータ
          data: [{{ $correct_num }}, {{ count($questions)-$correct_num }}]
      }]
  },
  options: {
    responsive: true,
  }
});
</script>
@endsection