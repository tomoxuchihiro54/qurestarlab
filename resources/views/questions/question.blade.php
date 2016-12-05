@extends('layouts.default')

@section('title', '平成28年度短答式問題（憲法）')

@section('include_script')
<script src="/js/timer.js"></script>
@endsection

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
<div id="ly-q-main">
  <div class="container">
    <div class="ly-q-area col-sm-12 col-xs-12">
      <div class="ly-q-num text-left">第{{ $question->id }}問</div>
      <div class="ly-q-tit text-left">{!! $question->title !!}</div>
      <div class="ly-q-limb text-left">
        @foreach ($question->questionChoices as $questionChoice)
        <p>{{ $questionChoice->sort }}.{{ $questionChoice->text }}</p>
        @endforeach
      </div>
      <div class="ly-answer-area text-center">
        <form id="question-form" method="post" name="question" class="ly-ans-btn-group" action="{{ action('QuestionsController@store', $question->id+1) }}">
          {{ csrf_field() }}
          <!-- 選択肢ラジオボタン -->
          @foreach($question->questionChoices as $questionChoice)
            <input type="radio" id="radio_btn_{{ $questionChoice->sort }}" class="ans_btn" name="choice_id" 
              value="{{ $questionChoice->id}}">
            <label for="radio_btn_{{ $questionChoice->sort }}" class="ly-q-btn">選択肢{{ $questionChoice->sort }}</label>
          @endforeach
          <input name="_pjax" type="hidden" value="true">
          <input name="counter" type="hidden" value="0">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection