@extends('layouts.default')

@section('title', '平成28年度短答式問題（憲法）| 解答結果')

@section('header_nav')

<!-- ヘッダー -start -->
<header>
  <nav class="ly-q-nav">
    <span class="ly-inline">
      <a href="#">
        <i class="fa fa-angle-left fa-2x" aria-hidden="true"></i>
      </a>
    </span>
    <h1 class="ly-logo ly-inline text-center">ロゴ</h1>
  </nav>
</header>
<!-- ヘッダー -end -->
@endsection

@section('content')
<div class="col-sm-12 col-xs-12">
  <div class="ly-result-area">
    <div class="total-status">
      <p>全体</p>
      <ul class="list-group">
        <li class="list-group-item">
          <span class="text-left">合計点</span>
          <span class="text-right">○/15点</span>
        </li>
        <!-- ▼全体の正答状況▼ -->
        <li class="ly-correct-area list-group-item">
            <span class="ly-title">正解数</span>
            <span class="ly-ans-rate">{{ $correct_num }}問/{{ count($questions) }}問</span>
        </li>
        <li class="text-center list-group-item">
          <!-- ▼正答グラフ▼ -->
          <div class="ly-correct-rate">{{ $u_ans_rate }}%</div>
          <div class="ly-incorrect-rate">{{ 100-$u_ans_rate }}%</div>
          <canvas id="new_result_pie" height="600" width="400"></canvas>
          <!-- ▲正答グラフ▲ -->
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
          <span class="pull-right">正解：{{ $questionChoice->sort }}&emsp;解答：{{ $userAnswerDetail->sort_id }}</span>
          @endif
          @endforeach
          <!-- ▲正解肢▲ -->
        </li>
        @endforeach
      </ul>
      <div class="ly-next-link text-center">
        <a href="#" class="btn btn-success btn-2x">次へ</a>
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
   color: "#0066ff",
   highlight: "#6495ed",
   label: "正解" 
 },
 {
  value: {{ count($questions)-$correct_num }},
  color:"#f7464a",
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