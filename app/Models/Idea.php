<?php

namespace App\Models;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date)
    {
        Date::setLocale('pt');

        return Date::createFromFormat('Y-m-d H:i:s', $date);
    }

    public function getUpdatedAtAttribute($date)
    {
        Date::setLocale('pt');
        
        return Date::createFromFormat('Y-m-d H:i:s', $date);
    }
}
