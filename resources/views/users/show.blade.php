@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h1>{{ $user->name }}</h1>
@if(\Auth::user()->isFollowing($user))
<form method="post" action="{{ route('follows.destroy', $user) }}">
    @csrf
    @method('delete')
    <input type="submit" value="フォロー解除">
</form>
@else
<form method="post" action="{{ route('follows.store') }}">
    @csrf
    <input type="hidden" name="follow_id" value="{{ $user->id }}">
    <input class="btn btn-success" type="submit" value="フォローする">
</form>
@endif
<form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="トップへ戻る">
</form>
</div>
@endsection