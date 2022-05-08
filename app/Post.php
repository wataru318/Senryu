<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Follow;

class Post extends Model
{
    protected $fillable = ['user_id', 'content', 'recommend_gender', 'recommend_age'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
