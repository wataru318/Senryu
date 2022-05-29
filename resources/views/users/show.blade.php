@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>{{ $title }}</h2>
@if($user->id !== \Auth::id())
<div class="row">
<div class="profile_image">
  @if($user->profile_image !== '')
      <img class="profile_image_size"  src="{{ asset('storage/' . $user->profile_image) }}">
  @else
      <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
  @endif
</div>
<h3 class="user_name">{{ $user->name }}</h3>
@if(\Auth::user()->isFollowing($user))
<form class="users_show_top_button" method="post" action="{{ route('follows.destroy', $user) }}">
    @csrf
    @method('delete')
    <input class="btn btn-secondary" type="submit" value="ふぉろー解除">
</form>
@else
<form class="users_show_top_button" method="post" action="{{ route('follows.store') }}">
    @csrf
    <input type="hidden" name="follow_id" value="{{ $user->id }}">
    <input class="btn btn-success" type="submit" value="ふぉろーする">
</form>
@endif
</div>
<div class="row">
<p><a href="{{ route('follows.following', $user->id)}}">ふぉろー</a>： {{ $my_follows }}</p>
<p><a class="pl-2" href="{{ route('follows.followers', $user->id)}}">ふぉろわー</a>： {{ $my_followers }}</p>
</div>
<p class="row">{{ $user->profile }}</p>
<ul>
@else
<div class="row">
<div class="profile_image">
  @if($user->profile_image !== '')
      <img class="profile_image_size"  src="{{ asset('storage/' . $user->profile_image) }}">
  @else
      <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
  @endif
</div>
<h3 class="user_name">{{ $user->name }}</h3>
<form class="users_show_top_button" method="get" action="{{ route('users.edit', \Auth::id()) }}">
    @csrf
    <input class="btn btn-primary" type="submit" value="編集する">
</form>
</div>
<div class="row">
<p><a href="{{ route('follows.following', \Auth::id())}}">ふぉろー</a>： {{ $my_follows }}</p>
<p><a class="pl-2" href="{{ route('follows.followers', \Auth::id())}}">ふぉろわー</a>： {{ $my_followers }}</p>
</div>
<p class="row">{{ $user->profile }}</p>
@endif
    <ul class="d-flex row">    
@forelse($user_posts as $user_post)
    <li class="d-block post_list_item col-12 col-md-6">
        <div class="post_header d-flex align-items-center py-2">
            <a href="{{ route('users.show', $user_post->user_id) }}">
                <div class="profile_image">
                    @if($user_post->user->profile_image !== '')
                        <img class="profile_image_size" src="{{ asset('storage/' . $user_post->user->profile_image) }}">
                    @else
                        <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
                    @endif
                </div>
                </a>
                <div class="post_header_details pl-3 align-items-center">
            <a href="{{ route('users.show', $user_post->user_id) }}">{{ $user_post->user->name }}</a>
            <p class="mb-0">@[{{ $user_post->created_at }}]</p>
            </div>
            <div class="ml-2 d-flex">
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
        </div>
        <div class="post_body">
        <div class="post_body_main_left">
        @if($user_post->post_image !== '')
        <img class="post_body_main_img" src="{{ asset('storage/' . $user_post->post_image) }}">
        @else
        <img class="post_body_main_img" src="{{ asset('images/no_image.png') }}">
        @endif
        </div>
        <div class="post_body_main_right">
        <p class="pt-3">{!! nl2br(e($user_post->content1)) !!}</p>
        <p class="pt-3">{!! nl2br(e($user_post->content2)) !!}</p>
        <p class="pt-3">{!! nl2br(e($user_post->content3)) !!}</p>
        </div>
        </div>
        <div class="d-flex justify-content-end">
            <p class="location position"></p>
            <a class="like_button pr-3" name="like">
                @if($user_post->isLikedBy(\Auth::user()) === true)
                <i class="on_icon fa-solid fa-bookmark"></i>
                @else
                <i class="off_icon fa-regular fa-bookmark"></i>
                @endif
            </a>
            <form method="post" class="like" action="{{ route('posts.toggle_like', $user_post) }}">
                @csrf
                @method('patch')
            </form>
        </div>
    </li>
@empty
投稿がありません。。。
@endforelse
</ul>
</div>
<script>
    function success(pos) {
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;
    $('.location').text(`緯度:${lat} 経度:${lng}で詠まれました`);
}

function fail(error) {
    alert('位置情報の取得に失敗しました。');
}

navigator.geolocation.getCurrentPosition(success, fail);
</script>
@endsection
