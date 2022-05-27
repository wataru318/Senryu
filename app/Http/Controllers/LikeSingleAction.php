<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeSingleAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function __invoke()
    {
        $like_posts = \Auth::user()->likePosts;
        return view('likes.likes', [
            'title' => 'お気に入り一覧',
            'like_posts' => $like_posts,
            ]);
    }
}
