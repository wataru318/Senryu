@extends('layouts.logged_in')

@section('title', $title)

@section('content')
 <div class="container">
  <h2>{{ $title }}</h2>
  <ul class="follow_list d-flex justify-content-center row">
      @forelse($followers as $follower)
          <li class="col-12 col-md-4  ml-2 mb-2 follow_list_item d-flex align-items-center">
          <a href="{{ route('users.show', $follower->id) }}">
          <div class="profile_image">
          @if($follower->profile_image !== '')
          <img class="profile_image_size" src="{{ asset('storage/' . $follower->profile_image) }}">
          @else
          <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
          @endif
          </div>
          </a>
            <a class="pl-3 follower_name" href="{{ route('users.show', $follower->id) }}">{{ $follower->name }}</a>
            <div class="follow_list_item_details pl-3">
            @if(\Auth::id() !== $follower->id)
            @if(\Auth::user()->isFollowing($follower))
              <form method="post" action="{{route('follows.destroy', $follower)}}" class="follow">
                @csrf
                @method('delete')
                <input  class="btn btn-secondary"type="submit" value="ふぉろー解除">
              </form>
            @else
              <form method="post" action="{{route('follows.store')}}" class="follow">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $follower->id }}">
                <input  class="btn btn-success" type="submit" value="ふぉろー">
              </form>
            @endif
            @endif
            </div>
          </li>
      @empty
          <li>ふぉろーされているゆーざーはいません。</li>
      @endforelse
  </ul>
  <form class="pt-5" method="get" action="{{ route('posts.index') }}">
    @csrf
    <input class="btn btn-info" type="submit" value="戻る">
</form>
  </div>
@endsection