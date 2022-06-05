<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Follow;
use App\Like;
use App\Http\Requests\PostRequest;
use App\Services\FileUploadService;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function nearby(Request $request){
         if(isset($request->longitude) && isset($request->latitude)){
            $longitude = $request->longitude;
            $latitude = $request->latitude;
        }else{
            $longitude = 135;
            $latitude = 35;
        }
         $user = \Auth::user();
        $follow_users_ids = $user->follow_users->pluck('id');
        $find_word = $request->input('find_word');
        if(isset($find_word)){
            $posts = Post::whereIn('user_id', $follow_users_ids)->orWhere('content1', 'LIKE', "%{$find_word}%")->orWhere('content2', 'LIKE', "%{$find_word}%")->orWhere('content3', 'LIKE', "%{$find_word}%")->latest()->get();
        } else{
            // $posts = $user->posts()->orWhereIn('user_id', $follow_users_ids)->latest()->get();
        $posts = $user->posts()->orWhereIn('user_id', $follow_users_ids)->selectRaw('id,user_id,created_at,updated_at,content1,content2,content3,post_image,latitude,longitude,(SQRT(POWER((latitude-?) / 0.0111, 2) 
+ POWER((longitude-?) / 0.0091, 2)))AS distance',[$latitude,$longitude])->orderBy('distance','asc')->get();
        }
        return view('posts.nearby', [
            'title' => 'ほーむ',
            'posts' => $posts,
            'recommended_users' => User::recommend($user->id)->get(),
            'find_word' => $find_word,
            'longitude' => $longitude,
            'latitude'=> $latitude
            ]);
       // SELECT SQRT(POWER((緯度1 – 緯度2) / 0.0111, 2) + POWER((経度1 – 経度2) / 0.0091, 2)) AS distance
        // /*
        // SELECT
        //   id,
        //   X(latitude) as lat,
        //   Y(longitude) as lng,
        //   (
        //     6371 * acos(
        //       cos(radians(35))
        //       * cos(radians(X(report_latlng)))
        //       * cos(radians(Y(report_latlng)) - radians(135))
        //       + sin(radians(35))
        //       * sin(radians(X(report_latlng)))
        //     )
        //   ) as distance
        // FROM
        //   posts
        // ORDER BY
        //   distance
        // LIMIT 10
        
        
        
        
        // */
        
    }
    
    public function index(Request $request){
        // if(isset($request->longitude) && isset($request->latitude)){
        //     $longitude = $request->longitude;
        //     $latitude = $request->latitude;
        // }else{
        //     $longitude = 135;
        //     $latitude = 35;
        // }
        
        $user = \Auth::user();
        $follow_users_ids = $user->follow_users->pluck('id');
        $find_word = $request->input('find_word');
        if(isset($find_word)){
            $posts = Post::whereIn('user_id', $follow_users_ids)->orWhere('content1', 'LIKE', "%{$find_word}%")->orWhere('content2', 'LIKE', "%{$find_word}%")->orWhere('content3', 'LIKE', "%{$find_word}%")->latest()->get();
        } else{
            $posts = $user->posts()->orWhereIn('user_id', $follow_users_ids)->latest()->get();
        }
        return view('posts.index', [
            'title' => 'ほーむ',
            'posts' => $posts,
            'recommended_users' => User::recommend($user->id)->get(),
            'find_word' => $find_word,
            // 'longitude' => $longitude,
            // 'latitude'=> $latitude
            ]);
    }
    
    public function create(){
        return view('posts.create', [
            'title' => '句を詠む'
            ]);
    }
    
    public function store(PostRequest $request, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('post_image'));
        
        Post::create([
            'user_id' => \Auth::user()->id,
            'content1' => $request->content1,
            'content2' => $request->content2,
            'content3' => $request->content3,
            'post_image' => $path,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            ]);
            session()->flash('success', '詠みました！');
            return redirect()->route('posts.index');
    }
    
    public function edit($id){
        $post = Post::find($id);
        return view('posts.edit', [
            'title' => '句の編集',
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
            'content', 'recommend_gender', 'recommend_age']));
            session()->flash('success', '句を更新しました！');
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
        \Session::flash('success', '句を削除しました');
        return redirect()->route('posts.index');
    }
    
    public function toggleLike($id)
    {
        $user = \Auth::user();
        $post = Post::find($id);
        
        if($post->isLikedBy($user)){
            $post->likes->where('user_id', $user->id)->first()->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                ]);
        }
        return back()->withInput();
    }
}
