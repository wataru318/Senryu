@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
    <h2>{{ $title }}</h2>
    <ul>    
@forelse($like_posts as $like_post)
    <li class="d-block post_list_item">
        <div class="post_header d-flex align-items-center py-2">
            <a href="{{ route('users.show', $like_post->user_id) }}">
                <div class="profile_image">
                    @if($like_post->user->profile_image !== '')
                        <img class="profile_image_size" src="{{ asset('storage/' . $like_post->user->profile_image) }}">
                    @else
                        <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
                    @endif
                </div>
                </a>
                <div class="post_header_details pl-3 align-items-center">
            <a href="{{ route('users.show', $like_post->user_id) }}">{{ $like_post->user->name }}</a>
            <p class="mb-0">@[{{ $like_post->created_at }}]</p>
            </div>
            <div class="ml-2 d-flex">
                        @if($like_post->user_id === \Auth::id())
                <form class="pr-3" method="get" action="{{ route('posts.edit', $like_post->id) }}">
                    @csrf
                    <input class="btn btn-primary" type="submit" value="編集">
                </form>
                <form method="post" action="{{ route('posts.destroy', $like_post->id) }}">
                    @csrf
                    @method('delete')
                    <input class="btn btn-danger delete_btn" type="submit" value="削除">
                </form>
            @endif
            </div>
        </div>
        <div class="post_body">
        <p class="pt-3">{!! nl2br(e($like_post->content1)) !!}</p>
        <p class="pt-3">{!! nl2br(e($like_post->content2)) !!}</p>
        <p class="pt-3">{!! nl2br(e($like_post->content3)) !!}</p>
        </div>
        <div class="d-flex justify-content-end">
            <a class="like_button pr-3" name="like">
                @if($like_post->isLikedBy(\Auth::user()) === true)
                <i class="on_icon fa-solid fa-bookmark"></i>
                @else
                <i class="off_icon fa-regular fa-bookmark"></i>
                @endif
            </a>
            <form method="post" class="like" action="{{ route('posts.toggle_like', $like_post) }}">
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