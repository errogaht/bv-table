<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class ProfileController extends Controller
{
    /**
     * Форма редактирования своего Профиля
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user/profile')->with([
            'page_title' => 'Профиль',
            'user' => \Auth::getUser(),
        ]);
    }


    /**
     * Сохранить свой Профиль
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = \Auth::getUser();

        $user->fill($request->all());

        $validator = \Validator::make($user->getAttributes(), $rules = self::getValidatorRules($user->id));
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $user->save();

        return redirect('profile');
    }


    public static function getValidatorRules($userId = 0)
    {
        return [
            'name'   => 'required|max:255|min:5',
            'email'  => "required|email|max:255|unique:users,email,{$userId},id",
            'phone'  => "required|digits_between:11,13|unique:users,phone,{$userId},id",
            'role'   => 'required|max:255|min:5',
            'sanga'  => 'required|max:255|min:5',
            'circle' => 'required|max:255|min:5',
        ];
    }
}
