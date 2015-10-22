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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($input = $request->all(), $rules = [
            'name'     => 'required|max:255|min:5',
            'email'    => 'required|email|max:255|unique:users',
            'phone'    => 'required|digits_between:11,13',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = \Auth::getUser();
        $user->fill(array_intersect_key($input, $rules));
        $user->save();

        return redirect('profile');
    }

}
