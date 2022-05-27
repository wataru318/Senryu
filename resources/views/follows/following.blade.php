@extends('layouts.logged_in')

@section('title', $title)

@section('content')
 <div class="container">
  <h2>{{ $title }}</h2>
  <ul class="follow_list d-flex justify-content-center row">
      @forelse($follow_users as $follow_user)
          <li class=" ml-2 mb-2 follow_list_item d-flex align-items-center">
          <a href="{{ route('users.show', $follow_user->id) }}">
          <div class="profile_image">
          @if($follow_user->profile_image !== '')
          <img class="profile_image_size" src="{{ asset('storage/' . $follow_user->profile_image) }}">
          @else
          <img class="profile_image_size"  src="{{ asset('images/no_image.png') }}">
          @endif
          </div>
          </a>
            <a class="pl-3" href="{{ route('users.show', $follow_user->id) }}">{{ $follow_user->name }}</a>
            <div class="follow_list_item_details pl-3">
            @if(\Auth::id() !== $follow_user->id)
            @if(\Auth::user()->isFollowing($follow_user))
              <form method="post" action="{{route('follows.destroy', $follow_user)}}" class="follow">
                @csrf
                @method('delete')
                <input  class="btn btn-secondary"type="submit" value="フォロー解除">
              </form>
            @else
              <form method="post" action="{{route('follows.store')}}" class="follow">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $follow_user->id }}">
                <input  class="btn btn-success" type="submit" value="フォロー">
              </form>
            @endif
            @endif
            </div>
          </li>
      @empty
          <li>フォローされているユーザーはいません。</li>
      @endforelse
  </ul>
  </div>
@endsection