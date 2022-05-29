@extends('layouts.not_logged_in')
@section('content')
<main class="top_main container">
    <div class="top_phraseBox row mb-3">
        <p class="top_phrase">川柳を</p>
        <p class="top_phrase">あなたが思う</p>
        <p class="top_phrase">その場所で</p>
    </div>
    <article class="top_discription">
        <section>
            <h2 class="top_discription_title">ココで一句って？</h2>
            <p class="top_discription_phrase">ココで一句とは、川柳のSNSです。川柳を投稿すると、位置情報もあわせて投稿され、投稿した人がどこでどんな思いでその句を詠んだのかが分かります。良い句があったら実際にその場所に行き、趣を感じてみてはいかが？</p>
        </section>
    </article>
    <form class="start_form" action="{{ route('login') }}" method="get">
        <p class="start_phrase">さぁ！始めよう！</p>
        <input class="btn btn-success w-75" type="submit" value="始める">
    </form>
</main>
@endsection