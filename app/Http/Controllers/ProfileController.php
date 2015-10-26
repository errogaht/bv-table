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

        $validator = \Validator::make($input = $request->all(), $rules = [
            'name'  => 'required|max:255|min:5',
            'email' => "required|email|max:255|unique:users,email,{$user->id},id",
            'phone' => 'required|digits_between:11,13',
            'role'  => 'required|max:255|min:5',
            'sanga' => 'required|max:255|min:5',
            'circle' => 'required|max:255|min:5',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user->fill(array_intersect_key($input, $rules));
        $user->save();

        return redirect('profile');
    }

}
