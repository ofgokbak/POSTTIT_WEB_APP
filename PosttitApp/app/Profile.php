<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];


    //default image set if profile image does not exists -Onur
    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/user_120px.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
