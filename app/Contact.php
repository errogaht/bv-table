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
        return $this->getAttribute('status');
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

    protected $set_mutators = [
        'name'           => 'trim',
        'email'          => 'trim|lower',
        'city'           => 'trim|ucfirst',
        'metro'          => 'trim|ucfirst',
        'age'            => 'int',
        'how_long'       => 'trim',
        'preferred_date' => 'trim',
        'comment'        => 'trim',
        'source'         => 'trim',
        'phone'          => 'phone',
    ];

    protected $casts = [
        'phone'          => 'phone',
    ];


    public function canStatusWork()
    {
        $status = $this->getStatus();
        return self::STATUS_NEW == $status || self::STATUS_FAIL == $status;
    }

    public function canStatusChange(User $user)
    {
        $status = $this->getStatus();
        return $user->id == $this->taken_by && (self::STATUS_WORK == $status || self::STATUS_SUCCESS == $status);
    }

    public static function countUserStats(User $user)
    {
        $result = [
            \App\Contact::STATUS_WORK => 0,
            \App\Contact::STATUS_SUCCESS => 0,
        ];
        $rows = \DB::select('select status, count(*) as count from contacts where taken_by=:id group by status', ['id' => $user->id]);
        foreach ($rows as $row) {
            $result[$row->status] = $row->count;
        }
        return $result;
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
