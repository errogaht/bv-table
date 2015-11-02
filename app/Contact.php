<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['created_at', 'name', 'phone', 'email', 'city', 'metro', 'age',
                           'how_long', 'preferred_date', 'status',
                           'comment', 'source'];

    /**
     * У контакта может быть один пользователь
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
