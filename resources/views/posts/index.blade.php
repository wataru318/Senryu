@extends('layouts.default')

@section('title', $title)

@section('content')

<script>
function locate() {
    navigator.geolocation.getCurrentPosition(locate2);
}

function locate2(position) {
    location.href = '/posts/nearby/'+position.coords.longitude+'/'+position.coords.latitude;
}

locate();
</script>
@endsection