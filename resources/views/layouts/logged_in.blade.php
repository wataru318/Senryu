@extends('layouts.default')
 
@section('header')
<header class="header">
    <div class="container-fluid">
        <div class="row">
  <a class="header_title" href="{{ route('posts.index') }}"><h1><b>いざっ！</b></h1></a>
    <p class="login_user pt-3 pl-3">こんにちは、{{ \Auth::user()->name }}さん！</p>
    <div class="btn_area ml-auto d-flex">
            <form class="pt-3" action="{{ route('users.show', \Auth::user()) }}" method="get">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="マイページ">
                </form>
            <form class="pt-3 pl-3" action="{{ route('posts.create') }}" method="get">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="新規投稿">
                </form>
            <form class="pt-3 pl-3" action="{{ route('logout') }}" method="POST">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="ログアウト">
            </form>
    </div>
        </div>
    </div>
</header>
@endsection