<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use App\User;

class FollowController extends Controller
{
    public function store(Request $request)
    {
        $user = \Auth::user();
        $following_user = User::find($request->follow_id);
        follow::create([
            'user_id' => $user->id,
            'follow_id' => $request->follow_id,
            ]);
            \Session::flash('success', 'フォローしました');
            return redirect()->route('users.show', $following_user);
    }
    
    public function destroy($id)
    {
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        \Session::flash('success', 'フォロー解除しました');
        return redirect()->route('users.show', $id);
        
    }
    
    public function followers()
    {
        return view('follows.followers', [
            'title' => 'フォロワー一覧',
            ]);
    }
    
    public function following()
    {
        return view('follows.following', [
            'title' => 'フォロー一覧',
            ]);
    }
}
