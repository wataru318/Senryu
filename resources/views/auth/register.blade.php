@extends('layouts.not_logged_in')
 
@section('content')
<div class="container">
  <h1>ユーザー登録</h1>
 
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="input_area">
      <label>
        ユーザー名:<br>
        <input type="text" name="name">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        性別:<br>
        <input type="radio" name="gender" value="0">男性
        <input type="radio" name="gender" value="1">女性
        <input type="radio" name="gender" value="2">答えない
      </label>
    </div>
 
    <div class="input_area">
      <label>
        年齢:<br>
        <input type="number" name="age" min="0" max="120">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        メールアドレス:<br>
        <input type="email" name="email">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        パスワード:<br>
        <input type="password" name="password">
      </label>
    </div>
 
    <div class="input_area">
      <label>
        パスワード（確認用）:<br>
        <input type="password" name="password_confirmation" >
      </label>
    </div>
 
    <div>
      <input class="submit_button" type="submit" value="登録">
    </div>
  </form>
  </div>
@endsection