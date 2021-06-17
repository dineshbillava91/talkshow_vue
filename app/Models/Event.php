<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name','location','date','time','users_id'];

    public function talks()
    {
        return $this->hasMany(Talks::class);
    }
}
