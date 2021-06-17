<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_ratings extends Model
{
    protected $fillable = ['user_id','talk_id','rating_id'];

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function talks()
    {
        return $this->hasMany(Talks::class);
    }
}
