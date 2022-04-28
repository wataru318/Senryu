@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h1>{{ $title }}</h1>
<ul>
@forelse($posts as $post)
<li class="d-block post_list_item">
    <p class="post_header d-inline">{{ \Auth::user()->name }}:{{ $post->created_at }}</p>
    <p class="post_body pt-3">{!! nl2br(e($post->content)) !!}</p>
    <div class="d-flex justify-content-end">
    <form class="pr-3" method="get" action="{{ route('posts.edit', $post->id) }}">
        @csrf
        <input class="btn btn-primary" type="submit" value="編集">
    </form>
    <form method="post" action="{{ route('posts.destroy', $post->id) }}">
        @csrf
        @method('delete')
        <input class="btn btn-danger delete_btn" type="submit" value="削除">
    </form>
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