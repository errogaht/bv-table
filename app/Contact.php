<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['date', 'name', 'phone', 'email', 'city', 'metro', 'age',
                           'how_long', 'preferred_date', 'about', 'user_text', 'status',
                           'comment', 'from', 'call_date_text', 'user_id'];
    /**
     * У контакта может быть один пользователь
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDateFormattedAttribute()
    {
        return Carbon::parse($this->date)->format('d.m.y');
    }
}
