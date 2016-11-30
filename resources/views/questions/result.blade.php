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
        <li class="ly-correct-area list-group-item">
          <a href="#">
            <span class="ly-title">正答率</span>
            <span class="ly-ans-rate">問/{{ $question_num }}問&emsp;{{ $u_ans_rate }}%</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="ly-correct-apiece">
      <ul class="list-group">
        @foreach ($u_ans->userAnswerDetails as $userAnswerDetail)
        <li class="list-group-item">
          <!-- ▼問題番号▼ -->
          <span>第{{ $userAnswerDetail->question_id }}問</span>
          <!-- ▲問題番号▲ -->
          <!-- ▼正解状況▼ -->
          @if ($userAnswerDetail->correct_flag === 1)
          <span class="text-primary"><i class="fa fa-circle-o" aria-hidden="true"></i></span>
          @else
          <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
          @endif
          <!-- ▲正解状況▲ -->
          <!-- ▼正解肢▼ -->
          @foreach ($userAnswerDetail->question->questionChoices as $questionChoice)
          @if ($questionChoice->correct_flag)
          <span>正解：{{ $questionChoice->sort }}</span>
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