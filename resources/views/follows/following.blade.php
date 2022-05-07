@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <h2>{{ $title }}</h2>
 
  <ul class="follow_users">
      @forelse($follow_users as $follow_user)
          <li class="follow_user">
            <a href="{{ route('users.show', $follow_user->id) }}">{{ $follow_user->name }}</p>
            @if(\Auth::id() !== $follow_user->id)
            @if(\Auth::user()->isFollowing($follow_user))
              <form method="post" action="{{route('follows.destroy', $follow_user)}}" class="follow">
                @csrf
                @method('delete')
                <input class="btn btn-secondary" type="submit" value="フォロー解除">
              </form>
            @else
              <form method="post" action="{{route('follows.store')}}" class="follow">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $follow_user->id }}">
                <input  class="btn btn-success"type="submit" value="フォロー">
              </form>
            @endif
            @endif
          </li>
      @empty
          <li>フォローしているユーザーはいません。</li>
      @endforelse
  </ul>
@endsection