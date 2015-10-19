<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'list' => \App\User::paginate(20),
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
        //return view('profile')->with(['profle' => \App\Profile::find($id)]);
        return view('profile');
    }

}
