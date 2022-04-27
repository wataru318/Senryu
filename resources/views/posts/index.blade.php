@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h1>{{ $title }}</h1>
<ul>
@forelse($posts as $post)
<li class="d-block">
    <p>{{ \Auth::user()->name }}:{{ $post->created_at }}</p>
    <p>{{ $post->content }}</p>
</li>
@empty
投稿がありません。。。
@endforelse
</ul>
</div>
@endsection