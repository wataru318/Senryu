<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Follow;


class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $my_follows = follow::where('user_id', $user->id)->count();
        $my_followers = follow::where('follow_id', $user->id)->count();
        $user_posts = $user->posts()->get();
        return view('users.show', [
            'title' => 'ユーザー詳細',
            'user' => $user,
            'user_posts' => $user_posts,
            'my_follows' => $my_follows,
            'my_followers' => $my_followers,
            ]);
    }
}
