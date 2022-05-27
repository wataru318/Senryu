@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>ユーザー編集</h1>
 
  <form method="POST" action="{{ route('users.update', \Auth::user()) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="input_area">
      <label>
        ユーザー名<br>
        <input type="text" name="name" value="{{ \Auth::user()->name }}">
      </label>
    </div>
 
    <div class="input_area">
        性別<br>
        <input type="radio" name="gender" value="0" <?php if(\Auth::user()->gender == "0"){print "checked";}?>>男性
        <input type="radio" name="gender" value="1" <?php if(\Auth::user()->gender == "1"){print "checked";}?>>女性
        <input type="radio" name="gender" value="2" <?php if(\Auth::user()->gender == "2"){print "checked";}?>>答えない
    </div>
 
    <div class="input_area">
      <label>
        年齢<br>
        <select name="age">
                @for($i = 1; $i < 9; $i++)
                <option value="{{ $i }}">{{ $i }}0代</option>
                @endfor
                <option value="10">90代以上</option>
            </select>
      </label>
    </div>
 
    
    <div class="input_area">
      <label>
        プロフィール<br>
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
      <input class="submit_button btn btn-primary" type="submit" value="登録する">
    </div>
  </form>
<form class="pt-5" method="get" action="{{ route('users.show', \Auth::user()) }}">
    @csrf
    <input class="btn btn-info" type="submit" value="戻る">
</form>
</div>
@endsection