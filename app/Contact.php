<?php namespace App;


class Contact extends BaseModel
{
    protected $fillable = [
        'created_at',
        'name',
        'phone',
        'email',
        'city',
        'metro',
        'age',
        'how_long',
        'preferred_date',
        'status',
        'comment',
        'source'
    ];

    protected $casts = [
        'name'           => 'trim',
        'email'          => 'trim|lower',
        'city'           => 'trim|ucfirst',
        'metro'          => 'trim|ucfirst',
        'age'            => 'int',
        'how_long'       => 'trim',
        'preferred_date' => 'trim',
        'comment'        => 'trim',
        'source'         => 'trim',
    ];

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = ltrim($value, '+');
    }

    /**
     * У контакта может быть один пользователь
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
