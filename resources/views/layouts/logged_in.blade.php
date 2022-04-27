@extends('layouts.default')
 
@section('header')
<header class="header">
    <div class="container-fluid">
        <div class="row">
  <a class="header_title" href="{{ route('posts.index') }}"><h1>Market</h1></a>
    <p class="login_user">こんにちは、{{ \Auth::user()->name }}さん！</p>
    <ul class="header_nav d-flex">
        <li>
          <a href="">
            投稿一覧
          </a>
        </li>
        <li>
          <a href="">
            新規投稿
          </a>
        </li>
        <li>
          <a href="">
          投稿
          </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input class="logout_button"  type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
        </div>
    </div>
</header>
@endsection