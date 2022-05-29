@extends('layouts.not_logged_in')
 
@section('content')
<div class="container">
  <h2>ろぐいん</h2>
  <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="input_area">
          <label>
            めーるあどれす<br>
            <input type="email" name="email">
          </label>
      </div>
 
      <div class="input_area">
          <label>
            ぱすわーど<br>
            <input type="password" name="password" >
          </label>
      </div>
      <input class="submit_button btn btn-success" type="submit" value="ろぐいん！">
  </form>
  <div class="row d-flex flex-column mt-3">
  <p>まだ未登録の方はこちら！</p>
  <form method="get" action="{{ route('register') }}">
    <input type="submit" value="新規登録" class="btn btn-primary">
  </form>
  </div>
</div>
@endsection