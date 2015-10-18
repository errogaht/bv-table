<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';


    /**
     * Форма регистрации
     *
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
        return view('auth.register', [
            'page_title' => 'Регистрация',
        ]);
    }


    /**
     * Форма авторизации
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login', [
            'page_title' => 'Авторизация',
        ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255|min:5',
            'email'    => 'required|email|max:255|unique:users',
            'phone'    => 'required|digits_between:11,13',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return \App\User::create([
            'name'     => $data['name'],
            'phone'    => ltrim($data['phone'], '+'),
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
