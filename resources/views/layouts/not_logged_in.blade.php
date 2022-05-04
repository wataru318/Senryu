@extends('layouts.default')
 
@section('header')
<header>
    <a class="header_title" href="{{ route('posts.index') }}"><h1><b>いざっ！</b></h1></a>
    <ul class="header_nav">
        <li>
          <a href="{{ route('register') }}">
            ユーザー登録
          </a>
        </li>
        <li>
          <a href="{{ route('login') }}">
            ログイン
          </a>
        </li>
    </ul>
</header>
@endsection