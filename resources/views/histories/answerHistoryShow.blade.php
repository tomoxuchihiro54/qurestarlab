@extends('layouts.default')

@section('title', '平成28年度短答式問題（憲法）| 解答結果')

@section('header_nav')

<!-- ヘッダー -start -->
<header class="ly-main-cont">
  <nav class="ly-q-nav">
    <h1 class="ly-logo ly-inline text-center"><img class="ly-top-logo" src="/images/qrestarLab-logo.png"></h1>
  </nav>
</header>
<!-- ヘッダー -end -->
@endsection

@section('content')
<div class="container">
  <div class="col-sm-12 col-xs-12">
    <div class="ly-result-area">
      <div class="total-status">
        <p>全体</p>
        <ul class="list-group">
          <li class="list-group-item">
            <span class="text-left">合計点</span>
            <span class="text-right">/{{ $questions->sum('point') }}点</span>
          </li>
          <!-- ▼全体の正答状況▼ -->
          <li class="ly-correct-area list-group-item">
              <span class="ly-title">正解数</span>
              <span class="ly-ans-rate">{{ $correct_num }}問/{{ count($questions) }}問</span>
          </li>
          <li class="text-center list-group-item">
            <!-- ▼スライダー▼ -->
            
            <div id="result-graph" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li class="active" data-target="#result-graph" data-slide-to="1"></li>
                <li data-target="#result-graph" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <!-- ▼1枚目▼ -->
                <div class="item active">
                  <!-- ▼正答グラフ情報▼ -->
                  <ul class="list-inline">
                    <li class="ly-correct-rate">
                      <span class="ly-graph-label">正解</span>{{ $u_ans_rate }}%
                    </li>
                    <li class="ly-incorrect-rate">
                      <span class="ly-graph-label">不正解</span>{{ 100-$u_ans_rate }}%
                    </li>
                  </ul>
                  <canvas id="new_result_pie" height="600" width="400"></canvas>
                  <!-- ▲正答グラフ情報▲ -->
                </div>
                <!-- ▲1枚目▲ -->
                <!-- ▼2枚目▼ -->
                <div class="item">
                  <canvas id="new_result_pie" height="600" width="400"></canvas>
                </div>
                <!-- ▲2枚目▲ -->
              </div>
              <a class="left carousel-control" href="#result-graph" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">前へ</span>
              </a>
              <a class="right carousel-control" href="#result-graph" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">次へ</span>
              </a>
            </div>
            <!-- ▲スライダー▲ -->
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
        <div class="ly-next-link text-center">
          <a href="{{ url('/dashboard') }}" class="btn btn-success btn-2x">次へ</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('jq_area')
<script>
  var data = [
 {
   value: {{ $correct_num }},
   color: "#5add5a",
   highlight: "#6495ed",
   label: "正解" 
 },
 {
  value: {{ count($questions)-$correct_num }},
  color:"#f08080",
  highlight: "#ff5a5e",
  label: "不正解"
 },
];
  
  var options = {
    showTooltips: false,
  };

var myChart = new Chart(document.getElementById("new_result_pie").getContext("2d")).Pie(data, options);
</script>
@endsection