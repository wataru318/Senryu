@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>{{ $title }}</h1>
<form method="post" action="{{ route('posts.store') }}">
    @csrf
    <textarea cols="50" rows="10" name="content" class="d-block mb-3"></textarea>
    <input class="btn btn-success" type="submit" value="投稿する">
</form>
<form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="トップへ戻る">
</form>
</div>
@endsection