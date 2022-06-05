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
function test() {
    navigator.geolocation.getCurrentPosition(test2);
}

function test2(position) {

    var geo_text = "緯度:" + position.coords.latitude + "\n";
    geo_text += "経度:" + position.coords.longitude + "\n";
    geo_text += "高度:" + position.coords.altitude + "\n";
    geo_text += "位置精度:" + position.coords.accuracy + "\n";
    geo_text += "高度精度:" + position.coords.altitudeAccuracy  + "\n";
    geo_text += "移動方向:" + position.coords.heading + "\n";
    geo_text += "速度:" + position.coords.speed + "\n";

    var date = new Date(position.timestamp);

    geo_text += "取得時刻:" + date.toLocaleString() + "\n";

    // alert(geo_text);
    document.getElementById('longitude').value = position.coords.longitude;
    document.getElementById('latitude').value = position.coords.latitude;

}

test();
</script>


</div>
@endsection