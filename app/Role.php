<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role'];

    public function posts()
    {
    	return $this->hasManyThrough("App\Post", "App\User", "role_id", "user_id", "id", "id");
    }
}
