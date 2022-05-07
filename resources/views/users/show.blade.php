@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>{{ $user->name }}</h2>
@if($user->id !== \Auth::id())
<p><a href="{{ route('follows.following', $user->id)}}">フォロー</a>： {{ $my_follows }}</p>
<p><a href="{{ route('follows.followers', $user->id)}}">フォロワー</a>： {{ $my_followers }}</p>
@if(\Auth::user()->isFollowing($user))
<form method="post" action="{{ route('follows.destroy', $user) }}">
    @csrf
    @method('delete')
    <input class="btn btn-secondary" type="submit" value="フォロー解除">
</form>
@else
<form method="post" action="{{ route('follows.store') }}">
    @csrf
    <input type="hidden" name="follow_id" value="{{ $user->id }}">
    <input class="btn btn-success" type="submit" value="フォローする">
</form>
@endif
<ul>
@else
<p><a href="{{ route('follows.following', \Auth::id())}}">フォロー</a>： {{ $my_follows }}</p>
<p><a href="{{ route('follows.followers', \Auth::id())}}">フォロワー</a>： {{ $my_followers }}</p>
@endif
@forelse($user_posts as $user_post)
<li class="d-block post_list_item">
<p class="post_header d-inline"><a href="{{ route('users.show', $user_post->user->id) }}">{{ $user_post->user->name }}</a>:{{ $user_post->created_at }}</p>
<p class="post_body pt-3">{!! nl2br(e($user_post->content)) !!}</p>
    <div class="d-flex justify-content-end">
        @if($user_post->user_id === \Auth::id())
    <form class="pr-3" method="get" action="{{ route('posts.edit', $user_post->id) }}">
        @csrf
        <input class="btn btn-primary" type="submit" value="編集">
    </form>
    <form method="post" action="{{ route('posts.destroy', $user_post->id) }}">
        @csrf
        @method('delete')
        <input class="btn btn-danger delete_btn" type="submit" value="削除">
    </form>
    @endif
    </div>
</li>
@empty
<li>投稿がありません！</li>
@endforelse
</ul>
<form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="トップへ戻る">
</form>
</div>
@endsection