<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('profile')->with([
        //    'profle' => \App\User::find($id)
        //]);
    }


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

        $data = $request->all();
        if (!empty($data['phone'])) {
            $data['phone'] = ltrim($data['phone'], '+');
        }

        $validator = \Validator::make($data, $rules = self::getValidatorRules($user->id));
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $user->fill(array_intersect_key($data, $rules));
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
