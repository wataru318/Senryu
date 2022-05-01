<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Follow extends Model
{
        protected $fillable = ['user_id', 'follow_id'];
}
