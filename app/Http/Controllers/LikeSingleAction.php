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
        return view('likes.likes', [
            'title' => 'お気に入り一覧',
            ]);
    }
}
