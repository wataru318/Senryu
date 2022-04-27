<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $posts = Post::where('user_id', \Auth::user()->id)->latest()->get();
        return view('posts.index', [
            'title' => '投稿一覧',
            'posts' => $posts,
            ]);
    }
    
    public function create(){
        return view('posts.create', [
            'title' => '新規投稿'
            ]);
    }
    
    public function store(PostRequest $request){
        Post::create([
            'user_id' => \Auth::user()->id,
            'content' => $request->content,
            ]);
            session()->flash('success', '投稿したよ！');
            return redirect()->route('posts.index');
    }
}
