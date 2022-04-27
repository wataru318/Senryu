@extends('layouts.default')
 
@section('header')
<header class="header">
    <div class="container-">
  <a class="header_title" href="{{ route('top.index') }}"><h1>Market</h1></a>
    <p class="login_user">こんにちは、{{ \Auth::user()->name }}さん！</p>
    <ul class="header_nav">
        <li>
          <a href="{{ route('users.show', \Auth::user()->id) }}">
            プロフィール
          </a>
        </li>
        <li>
          <a href="{{ route('likes.index') }}">
            お気に入り一覧
          </a>
        </li>
        <li>
          <a href="{{ route('users.exhibitions', \Auth::user()->id) }}">
          出品商品一覧
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
</header>
@endsection