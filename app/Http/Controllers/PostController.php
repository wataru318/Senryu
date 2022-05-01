<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Follow;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $user = \Auth::user();
        $follow_users_ids = $user->follow_users->pluck('id');
        $find_word = $request->input('find_word');
        // dd($posts_content);
        if(isset($find_word)){
            $posts = Post::whereIn('user_id', $follow_users_ids)->where('content', 'LIKE', "%{$find_word}%")->latest()->get();
        } else{
            $posts = $user->posts()->orWhereIn('user_id', $follow_users_ids)->latest()->get();
        }
        return view('posts.index', [
            'title' => '投稿一覧',
            'posts' => $posts,
            'recommended_users' => User::recommend($user->id)->get(),
            'find_word' => $find_word,
            ]);
    }
    
    public function create(){
        return view('posts.create', [
            'title' => '新規投稿'
            ]);
    }
    
    public function store(PostRequest $request)
    {
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
