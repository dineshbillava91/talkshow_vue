<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    protected $fillable = ['name','value'];

    public function user_ratings()
    {
        return $this->hasMany(User_ratings::class);
    }
}
