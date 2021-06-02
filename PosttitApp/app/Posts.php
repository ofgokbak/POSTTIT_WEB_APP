<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $guarded = [];

    public function postImage()
    {

        return '/storage/' . 'uploads/account.png';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')->orderBy('created_at', 'DESC');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
