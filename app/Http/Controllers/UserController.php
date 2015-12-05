<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;


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
            'me' => \Auth::getUser(),
        ]);
    }


    /**
     * Активировать/Заблокировать пользователя
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function active(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (\Auth::getUser()->is_admin) {
            $user->is_active = (bool) $request->get('action', false);
            $user->save();
            $message = $user->is_active ? 'Активирован' : 'Заблокирован';
            \Flash::success('Пользователь успешно '.$message);
        }

        return redirect(route('user.show', $id));
    }

}
