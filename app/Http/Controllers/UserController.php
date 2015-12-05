<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/index')->with([
            'list' => \App\User::
                orderBy('is_active', 'ASC')
                ->orderBy('is_admin', 'DESC')
                ->orderBy('name', 'ASC')
                ->paginate(20),
            'page_title' => 'Пользователи',
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user/show')->with([
            'page_title' => 'Пользователи - '.$user->name,
            'user' => $user,
        ]);
    }

}
