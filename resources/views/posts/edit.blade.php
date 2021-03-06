@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>{{ $title }}</h1>
<form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <h3>入力欄</h3>
    <input type="text" name="content1" class="d-block mb-3 w-25" value="{{ $post->content1}}">
    <input type="text" name="content2" class="d-block mb-3 w-50" value="{{ $post->content2}}">
    <input type="text" name="content3" class="d-block mb-3 w-25" value="{{ $post->content3}}">
    @if($post->post_image !== '')
        <img style='width:100px' class="post_body_main_img" src="{{ asset('storage/' . $post->post_image) }}">
    @else
        <img style='width:100px' class="post_body_main_img" src="{{ asset('images/no_image.png') }}">
    @endif

    <input type="file" name="post_image"><br>
    <input class="btn btn-success mt-3" type="submit" value="投稿する">
</form>
<form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="戻る">
</form>
</div>
</div>
@endsection