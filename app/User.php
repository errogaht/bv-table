<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone', 'role', 'sanga', 'circle'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $set_mutators = [
        'name'      => 'trim',
        'email'     => 'trim|lower',
        'role'      => 'trim',
        'sanga'     => 'trim',
        'circle'    => 'trim',
        'phone'     => 'phone',
        'is_admin'  => 'db_bool',
        'is_active' => 'db_bool',
    ];

    protected $casts = [
        'phone'     => 'phone',
        'is_admin'  => 'db_bool',
        'is_active' => 'db_bool',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Authority\Role');
    }

    public function permissions()
    {
        return $this->hasMany('App\Authority\Permission');
    }

    public function hasRole($key)
    {
        $hasRole = false;
        foreach ($this->roles as $role) {
            if ($role->name === $key) {
                $hasRole = true;
                break;
            }
        }

        return $hasRole;
    }

    /**
     * У пользователя могут быть несколько контактов
     */
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function getProfileImage($size = 100)
    {
        return sprintf("http://www.gravatar.com/avatar/%s?s=%d&amp;d=wavatar", md5($this->email), $size);
    }
}
