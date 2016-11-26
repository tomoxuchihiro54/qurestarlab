@extends('layouts.default')

@section('title', '平成28年度短答式問題（憲法）')

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
<div class="ly-q-area col-sm-12 col-xs-12">
  <div class="ly-q-num text-left">第{{ $question->id }}問</div>
  <div class="ly-q-tit text-left">{!! $question->title !!}</div>
  <div class="ly-q-limb text-left">
    @foreach ($question->questionChoices as $question->questionChoice)
    <p>{{ $question->questionChoice->text }}</p>
    @endforeach
  </div>
  <div class="ly-answer-area">
    <form method="post" action="{{ action('QuestionsController@store', $question->id+1) }}">
      {{ csrf_field() }}
      <input type="hidden" value="{{ $question->id }}">
      @foreach($question->questionChoices as $key => $question->questionChoice)
        <input type="radio" name="correct_flag" onclick="submit();"
          value="{{ $question->questionChoice->correct_flag}}">選択肢{{ $key+=1 }}
      @endforeach
<!--      <input type="submit" class="btn btn-success btn-lg" value="提出">-->
    </form>
  </div>
</div>
@endsection