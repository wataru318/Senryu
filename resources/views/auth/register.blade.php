@extends('layouts.not_logged_in')
 
@section('content')
<div class="container">
  <h2>ゆーざー登録</h1>
 
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="input_area">
      <label>
        ゆーざー名<br>
        <input type="text" name="name">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        めーるあどれす<br>
        <input type="email" name="email">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        ぱすわーど<br>
        <input type="password" name="password">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        ぱすわーど（確認用）<br>
        <input type="password" name="password_confirmation" >
      </label>
    </div>
 
    <div>
      <input class="submit_button btn btn-primary" type="submit" value="登録">
    </div>
  </form>
  </div>
@endsection