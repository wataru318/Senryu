@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<div class="container">
<h2>{{ $title }}</h1>
<form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <h3>入力欄</h3>
    <input type="text" name="content1" class="d-block mb-3 w-25" placeholder="上">
    <input type="text" name="content2" class="d-block mb-3 w-50" placeholder="中">
    <input type="text" name="content3" class="d-block mb-3 w-25" placeholder="下">
    <input type="file" name="post_image"><br>
    <input type='hidden' id='longitude' name='longitude'>
    <input type='hidden' id='latitude' name='latitude' >
    <input class="btn btn-success mt-3" type="submit" value="投稿する">
</form>
<form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="戻る">
</form>
<script>
function locate() {
    navigator.geolocation.getCurrentPosition(locate2);
}

function locate2(position) {
    document.getElementById('longitude').value = position.coords.longitude;
    document.getElementById('latitude').value = position.coords.latitude;
}

locate();
</script>
</div>
@endsection