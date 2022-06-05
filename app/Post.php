<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Follow;

class Post extends Model
{
    protected $fillable = ['user_id', 'content1', 'content2', 'content3', 'post_image','latitude','longitude'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function likes(){
        return $this->hasmany('App\Like');
    }
    
    public function likedUsers(){
        return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikedBy($user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }
}
