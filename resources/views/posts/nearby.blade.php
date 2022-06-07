@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <div class="container">
    <h2>おすすめゆーざー</h2>
    <ul class="recommended_users row">
@forelse($recommended_users as $recommend_user)
    <li class="col-2  text-center">
    <a class="d-block" href="{{ route('users.show', $recommend_user) }}">
    <div class="profile_image">
        @if($recommend_user->profile_image !== '')
            <img class="profile_image_size"  src="{{ asset('storage/' . $recommend_user->profile_image) }}">
        @else
            <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
        @endif
    </div>
    <p>{{ $recommend_user->name }}</p>
    </a></li>
@empty
    <li>おすすめゆーざーはいません！<br>ぜひ外の世界に目を向けましょう！</li>
@endforelse
    </ul>
    <h2>たいむらいん</h2>
    <form method="get" action="{{ route('posts.index') }}">
        <div class="input-group mb-3">
            <input name="find_word" value="{{ $find_word }}" type="text" class="form-control" placeholder="たいむらいんを検索" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary find_button" type="button" id="button-addon2">検索</button>
            </div>
        </div>
    </form>
    <ul class="d-flex row">    
@forelse($posts as $post)
    <li class="d-block post_list_item col-12 col-lg-5 ml-lg-5">
        <div class="post_header d-flex align-items-center py-2">
            <a href="{{ route('users.show', $post->user_id) }}">
                <div class="profile_image">
                    @if($post->user->profile_image !== '')
                        <img class="profile_image_size" src="{{ asset('storage/' . $post->user->profile_image) }}">
                    @else
                        <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
                    @endif
                </div>
                </a>
                <div class="post_header_details pl-3 align-items-center">
            <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a>
            <p class="mb-0">@[{{ $post->created_at }}]</p>
            </div>
            <div class="ml-2 d-flex">
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
        </div>
        <div class="post_body">
        <div class="post_body_main_left">
        @if($post->post_image !== '')
        <img class="post_body_main_img" src="{{ asset('storage/' . $post->post_image) }}">
        @else
        <img class="post_body_main_img" src="{{ asset('images/no_image.png') }}">
        @endif
        </div>
        <div class="post_body_main_right">
        <p>{!! nl2br(e($post->content1)) !!}</p>
        <p>{!! nl2br(e($post->content2)) !!}</p>
        <p>{!! nl2br(e($post->content3)) !!}</p>
        </div>
        </div>
        <div class="d-flex justify-content-end">
            <p class="location position">緯度:{{$post->latitude}} 経度:{{$post->longitude}}で詠まれました</p>
            <a class="like_button pr-3" name="like">
                @if($post->isLikedBy(\Auth::user()) === true)
                <i class="on_icon fa-solid fa-bookmark"></i>
                @else
                <i class="off_icon fa-regular fa-bookmark"></i>
                @endif
            </a>
            <form method="post" class="like" action="{{ route('posts.toggle_like', $post) }}">
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
@endsection