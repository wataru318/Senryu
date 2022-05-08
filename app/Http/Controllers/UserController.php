<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\User;
use App\Post;
use App\Follow;

use App\Services\FileUploadService;


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
    
    public function edit($id){
        return view('users.edit', [
            'title' => 'ユーザー編集',
            ]);
    }
    
    public function update($id, UserRequest $request, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        
        $user = \Auth::user();
        if($user->profile_image !== ''){
        \Storage::disk('public')->delete('photos/' . $user->profile_image);
      }
      $user->update(
      $request->only([
          'name', 'gender', 'age', 'profile'])
          );
      $user->update(['profile_image' => $path]);
    
      \Session::flash('success', 'プロフィールを編集しました');
      return redirect()->route('users.show', $user);
    }
}
