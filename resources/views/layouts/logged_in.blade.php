@extends('layouts.default')
 
@section('header')
<header class="header">
    <div class="container-fluid">
        <div class="row heade_content">
            <div class="col-12 col-lg-8 d-flex">
  <a class="header_title" href="{{ route('posts.index') }}"><h1><b>ココで一句</b></h1></a>
    <p class="login_user pt-3 pl-3">ようこそ！{{ \Auth::user()->name }}さん！</p>
    </div>
    <div class="col-12 col-lg-4">
    <div class="btn_area d-flex justify-content-center">
            <form class="pt-3" action="{{ route('users.show', \Auth::user()) }}" method="get">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="ぷろふぃーる">
                </form>
            <form class="pt-3 pl-3" action="{{ route('posts.create') }}" method="get">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="句を詠む">
                </form>
            <form class="pt-3 pl-3" action="{{ route('logout') }}" method="POST">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="ろぐあうと">
            </form>
            </div>
    </div>
        </div>
    </div>
</header>
@endsection
@section('footer')
    <footer class="footer">
        <div class="container-fluid text-center">
            <ul class="footer_list nav flex-column flex-md-row justify-content-center">
                <li class="nav-item"><a href="{{ route('follows.following', \Auth::id()) }}" class="nav-link">ふぉろー</a></li>
                <li class="nav-item"><a href="{{ route('follows.followers', \Auth::id()) }}" class="nav-link">ふぉろわー</a></li>
                <li class="nav-item"><a href="{{ route('likes.likes') }}" class="nav-link">良き句</a></li>
            </ul>
            <small>Copyright&copy; 2022 Wataru Ito All Rights Reserved.</small>
        </div>
    </footer>
@endsection