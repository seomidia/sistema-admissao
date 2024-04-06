<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;

    public function scopeCurrentUser($query)
    {
        if(\Auth::user()->role->name == 'empresa')
            return  $query->where('user_id', \Auth::user()->id);
    }
}
