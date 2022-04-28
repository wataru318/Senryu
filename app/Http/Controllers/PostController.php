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
    
    public function store(PostRequest $request)
    {
        if($post->user_id !== \Auth::id()){
            session()->flash('error', '不正な操作が検知されました');
            return redirect()->route('posts.index');
        }
        Post::create([
            'user_id' => \Auth::user()->id,
            'content' => $request->content,
            ]);
            session()->flash('success', '投稿したよ！');
            return redirect()->route('posts.index');
    }
    
    public function edit($id){
        $post = Post::find($id);
        return view('posts.edit', [
            'title' => '投稿編集',
            'post' => $post,
            ]);
    }
    
    public function update($id, PostRequest $request)
    {
        $post = Post::find($id);

        if($post->user_id !== \Auth::id()){
            session()->flash('error', '不正な操作が検知されました');
            return redirect()->route('posts.index');
        }
        
        $post->update($request->only([
            'content']));
            session()->flash('success', '投稿を更新しました！');
            return redirect()->route('posts.index');
    }
    
    public function destroy($id)
    {
        $post = Post::find($id);
        
        if($post->user_id !== \Auth::id()){
            session()->flash('error', '不正な操作が検知されました');
            return redirect()->route('posts.index');
        }
        
        $post->delete();
        \Session::flash('success', '投稿を削除しました');
        return redirect()->route('posts.index');
    }
}
