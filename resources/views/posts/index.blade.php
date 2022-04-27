@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h1>{{ $title }}</h1>
<ul>
@forelse($posts as $post)
<li class="d-block post_list_item">
    <p class="post_header d-inline">{{ \Auth::user()->name }}:{{ $post->created_at }}</p>
    <p class="post_body">{{ $post->content }}</p>
</li>
@empty
投稿がありません。。。
@endforelse
</ul>
</div>
@endsection