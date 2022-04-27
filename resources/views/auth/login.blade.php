@extends('layouts.not_logged_in')
 
@section('content')
<div class="container">
  <h1>ログイン</h1>
 
  <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="input_area">
          <label>
            メールアドレス:<br>
            <input type="email" name="email">
          </label>
      </div>
 
      <div class="input_area">
          <label>
            パスワード:<br>
            <input type="password" name="password" >
          </label>
      </div>
 
      <input class="submit_button" type="submit" value="ログイン">
  </form>
</div>
@endsection