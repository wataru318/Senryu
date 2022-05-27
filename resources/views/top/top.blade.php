@extends('layouts.not_logged_in')
@section('content')
    <div id="cl" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#cl" data-slide-to="0" class="active"></li>
            <li data-target="#cl" data-slide-to="1"></li>
            <li data-target="#cl" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active"><img src="images/carousel_img1.jpg" class="d-block w-100"></div>
            <div class="carousel-item"><img src="images/carousel_img2.jpg" class="d-block w-100"></div>
            <div class="carousel-item"><img src="images/carousel_img3.jpg" class="d-block w-100"></div>
            <p class="carousel-phrase">ちょっとココらで<br>川柳でも</p>
        </div>
        <a class="carousel-control-prev" href="#cl" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#cl" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <div class="top_img">
        <p class="top_img_phrase">"<b>ココで一句</b>"ってなに？</p>
    </div>
    <article class="top_description container">
        <p>その場所で<br>あなたが思う<br>川柳を</p>
        <section class="row align-items-center top_description_section">
            <img class="col-md-5 col-12" src="images/top_description_img.jpg">
            <p class="col-md-7 col-12 top_description_content">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
        </section>
    </article>
@endsection