<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public function talks()
    {
        return $this->hasMany(Users::class);
    }
}
