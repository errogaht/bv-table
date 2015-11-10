<?php namespace App;


class ContactLog extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'comment',
    ];

    protected $casts = [
        'comment' => 'trim',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}