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
            \Session::flash('success', 'ふぉろーしました');
            return back()->withInput();
    }
    
    public function destroy($id)
    {
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        \Session::flash('success', 'ふぉろー解除しました');
        return back()->withInput();
        
    }
    
    public function followers($id)
    {
        $followers = User::find($id)->followers;
        return view('follows.followers', [
            'title' => 'ふぉろわー一覧',
            'followers' => $followers,
            ]);
    }
    
    public function following($id)
    {
        $follow_users = User::find($id)->follow_users;
        return view('follows.following', [
            'title' => 'ふぉろー一覧',
            'follow_users' => $follow_users,
            ]);
    }
}
