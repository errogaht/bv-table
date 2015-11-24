<?php namespace App;


class Contact extends BaseModel
{
    const STATUS_NEW = 1;
    const STATUS_WORK = 2;
    const STATUS_SUCCESS = 3;
    const STATUS_FAIL = 9;

    private static $statuses = [
        self::STATUS_NEW     => 'Новый',
        self::STATUS_WORK    => 'Обработка',
        self::STATUS_SUCCESS => 'Посещает',
        self::STATUS_FAIL    => 'Отказ',
    ];

    public function getStatus($label = false)
    {
        if ($label) {
            return self::$statuses[$this->status];
        }
        return $this->status;
    }


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

    public function created_by_user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function taken_by_user()
    {
        return $this->belongsTo('App\User', 'taken_by');
    }

    public function getDates()
    {
        return ['created_at', 'updated_at', 'taken_at'];
    }
}
