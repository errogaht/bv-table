<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Laracasts\Flash\Flash;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('table')->with([
            'page_title' => 'Контакты',
            'contacts' => \App\Contact::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $contact = \App\Contact::create($request->input());
        Flash::success('Контакт успешно добавлен');
        return view('table')->with(['contacts' => \App\Contact::all()]);
    }


    /**
     * Просмотр
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact/show')->with([
            'page_title' => $contact->name,
            'page_description' => 'Добавлен: ' . $contact->created_at->format('d.m.Y'),
            'contact' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('contact.edit-form')->with(['contact' => \App\Contact::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = \App\Contact::find($id);
        if ($contact->count() > 0) {
            $contact->update($request->input());
            Flash::success('Контакт успешно обновлён');
        }
        return view('table')->with(['contacts' => \App\Contact::all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
