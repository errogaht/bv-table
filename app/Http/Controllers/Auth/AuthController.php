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
    protected function validator(array $input)
    {
        $rules = \App\Http\Controllers\ProfileController::getValidatorRules();
        $rules['password'] = 'required|confirmed|min:6';

        $user = new User($input);
        $data = $user->getAttributes();
        $data['password'] = $input['password'];
        $data['password_confirmation'] = $input['password_confirmation'];

        return Validator::make($data, $rules);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return \App\User::create($data);
    }
}
