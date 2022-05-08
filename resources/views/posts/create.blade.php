@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>{{ $title }}</h1>
<form method="post" action="{{ route('posts.store') }}">
    @csrf
    投稿内容<br>
    <textarea cols="50" rows="10" name="content" class="d-block mb-3"></textarea>
    <div class="input_area">
        <input type="radio" name="recommend_gender" value="0">男性向き
        <input type="radio" name="recommend_gender" value="1">女性向き
        <input type="radio" name="recommend_gender" value="2">どちらにも！
    </div>
 
    <div class="input_area">
      <label>
        対象年齢<br>
        <input type="number" name="recommend_age" min="0" max="120">
      </label>
    </div>
    <input class="btn btn-success" type="submit" value="投稿する">
</form>
<form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="トップへ戻る">
</form>
</div>
@endsection