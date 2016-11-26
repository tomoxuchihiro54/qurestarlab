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
  <p>全体</p>
  <ul class="list-group">
    <li class="list-group-item">
      <span class="text-left">合計点</span>
      <span class="text-right">○/15点</span>
    </li>
    <li class="list-group-item">
      <span class="text-left">正答率</span>
      <span class="text-right">{{ $question}}</span>
    </li>
	<li class="list-group-item">リスト項目Ｃ</li>
  </ul>
</div>
@endsection