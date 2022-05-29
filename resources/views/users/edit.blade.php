@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>ゆーざー編集</h1>
 
  <form method="POST" action="{{ route('users.update', \Auth::user()) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="input_area">
      <label>
        ゆーざー名<br>
        <input type="text" name="name" value="{{ \Auth::user()->name }}">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        ぷろふぃーる<br>
        <textarea cols=20 rows=5 name="profile">{{ \Auth::user()->profile }}</textarea>
      </label>
    </div>
    
    <div class="input_area">
        @if(\Auth::user()->profile_image !== '')
        <img class="profile_image_size"  src="{{ asset('storage/' .\Auth::user()->profile_image) }}">
        @else
        <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
        @endif
        <label>
            画像を選択
            <input type="file" name="image" >
        </label>
    </div>
 
    
    <div>
      <input class="submit_button btn btn-primary mt-3" type="submit" value="登録する">
    </div>
  </form>
<form class="pt-5" method="get" action="{{ route('users.show', \Auth::user()) }}">
    @csrf
    <input class="btn btn-info" type="submit" value="戻る">
</form>
</div>
@endsection