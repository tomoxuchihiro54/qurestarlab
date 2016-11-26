@extends('layouts.default')

@section('title', '司法試験 | 演習')

@section('header_nav')

<!-- ヘッダー -start -->
<header>
  <nav class="ly-q-nav">
    <span class="ly-inline">
      <a href="#">
        <i class="fa fa-angle-left fa-2x" aria-hidden="true"></i>
      </a>
    </span>
    <h1 class="ly-logo ly-inline ">ロゴ</h1>
  </nav>
</header>
<!-- ヘッダー -end -->
@endsection

@section('content')
  <form method="post" class="text-center"
        action="{{url('/questions')}}">
    <input type="submit" class="btn btn-success btn-lg" value="スタート">
  </form>
@endsection