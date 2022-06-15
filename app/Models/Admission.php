<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    public function scopeCurrentUser($query)
    {
        return  $query->where('user_id', \Auth::user()->id);
    }
}
