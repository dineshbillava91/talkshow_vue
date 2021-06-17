<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talks extends Model
{
    protected $fillable = ['name','title','description','speaker_id','event_id','participants','tags','users_id'];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user_ratings()
    {
        return $this->belongsTo(User_ratings::class);
    }
}
