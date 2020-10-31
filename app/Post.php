<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'body'];

    public function user()
    {
    	return $this->belongsTo("App\User");
    }

    public function categories()
    {
    	return $this->belongsToMany("App\Category");
    }

    public function comments()
    {
    	return $this->morphMany("App\Comment", 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany("App\Tag", 'taggable');
    }
}
