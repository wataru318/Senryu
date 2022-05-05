@extends('layouts.default')
 
@section('header')
<header class="header">
    <div class="container-fluid">
        <div class="row heade_content">
  <a class="header_title" href="{{ route('top.top') }}"><h1><b>いざっ！</b></h1></a>
    <div class="btn_area ml-auto d-flex">
            <form class="pt-3" action="{{ route('register') }}" method="get">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="新規登録">
                </form>
            <form class="pt-3 pl-3" action="{{ route('login') }}" method="get">
                @csrf
                <input class="btn_flat_stripe"  type="submit" value="ログイン">
                </form>
    </div>
        </div>
    </div>
</header>
@endsection