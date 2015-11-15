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

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}