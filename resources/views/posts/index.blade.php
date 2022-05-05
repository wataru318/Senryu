@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>おすすめユーザー</h2>
<ul class="recommended_users">
@forelse($recommended_users as $recommend_user)
<li><a href="{{ route('users.show', $recommend_user) }}">{{ $recommend_user->name }}</a></li>
@empty
<li>おすすめユーザーがいません！<br>ぜひ外の世界に目を向けましょう！</li>
@endforelse
</ul>
<h2>{{ $title }}</h2>
<form method="get" action="{{ route('posts.index') }}">
<div class="input-group mb-3">
  <input name="find_word" value="{{ $find_word }}" type="text" class="form-control" placeholder="投稿内を検索" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary find_button" type="button" id="button-addon2">検索</button>
  </div>
</div>
</form>
<ul>
@forelse($posts as $post)
<li class="d-block post_list_item">
    <p class="post_header d-inline">
        <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a>:{{ $post->created_at }}</p>
    <p class="post_body pt-3">{!! nl2br(e($post->content)) !!}</p>
    <div class="d-flex justify-content-end">
        @if($post->user_id === \Auth::id())
    <form class="pr-3" method="get" action="{{ route('posts.edit', $post->id) }}">
        @csrf
        <input class="btn btn-primary" type="submit" value="編集">
    </form>
    <form method="post" action="{{ route('posts.destroy', $post->id) }}">
        @csrf
        @method('delete')
        <input class="btn btn-danger delete_btn" type="submit" value="削除">
    </form>
    @endif
    </div>
</li>
@empty
投稿がありません。。。
@endforelse
</ul>
</div>
<script>
    $('.delete_btn').click(function(){
    if(!confirm('本当に削除しますか？')){
        return false;
    }else{
        location.href = 'index.html';
    }
});
</script>
@endsection