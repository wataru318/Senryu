@extends('layouts.default')
 
@section('header')
<header class="header">
    <div class="container-fluid">
        <div class="row heade_content">
  <a class="header_title" href="{{ route('posts.index') }}"><h1><b>いざっ！</b></h1></a>
    <p class="login_user pt-3 pl-3">ようこそ！{{ \Auth::user()->name }}さん！</p>
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
@section('footer')
    <footer class="footer">
        <div class="container-fluid text-center">
            <ul class="footer_list nav flex-column flex-md-row justify-content-center">
                <li class="nav-item"><a href="{{ route('follows.following') }}" class="nav-link">フォロー</a></li>
                <li class="nav-item"><a href="{{ route('follows.followers') }}" class="nav-link">フォロワー</a></li>
                <li class="nav-item"><a href="{{ route('likes.likes') }}" class="nav-link">お気に入り</a></li>
                <li class="nav-item"><a href="{{ route('contact.contact') }}" class="nav-link">お問い合わせ</a></li>
            </ul>
            <small>Copyright&copy; 2022 Wataru Ito All Rights Reserved.</small>
        </div>
    </footer>
@endsection