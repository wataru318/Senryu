<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $user_posts = $user->posts()->get();
        return view('users.show', [
            'title' => 'ユーザー詳細',
            'user' => $user,
            'user_posts' => $user_posts,
            ]);
    }
}
