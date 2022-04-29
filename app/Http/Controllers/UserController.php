<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        return view('users.show', [
            'title' => 'ユーザー詳細',
            'user' => $user,
            ]);
    }
}
