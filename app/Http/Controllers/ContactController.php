<?php namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Flash\Flash;


/**
 * Контакты
 */
class ContactController extends Controller
{
    /**
     * Список
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact/index')->with([
            'page_title' => 'Контакты',
            'contacts' => \App\Contact::all()
        ]);
    }


    /**
     * Форма добавления
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact/edit')->with([
            'contact' => new Contact,
            'page_title' => 'Добавить контакт',
        ]);
    }


    /**
     * Добавить контакт
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $validator = \Validator::make($data, $rules = self::getValidatorRules());
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $contact = \App\Contact::create($request->input());
        Flash::success('Контакт успешно добавлен');

        return redirect(route('contact.edit', $contact));
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
     * Форма Редактирования
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact/edit')->with([
            'contact' => $contact,
            'page_title' => $contact->name,
            'page_description' => 'Добавлен: ' . $contact->created_at->format('d.m.Y'),
            'title_link' => route('contact.show', $contact),
        ]);
    }


    /**
     * Редактировать
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $data = $request->all();
        $validator = \Validator::make($data, $rules = self::getValidatorRules($contact->id));
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $contact->update($request->input());
        Flash::success('Контакт успешно обновлён');

        return redirect(route('contact.edit', $contact));
    }


    /**
     * Правила для валидатора
     *
     * @param int $contactId
     * @return array
     */
    public static function getValidatorRules($contactId = 0)
    {
        return [
            'name'   => 'required|max:255|min:2',
            'email'  => "email|max:255|unique:contacts,email,{$contactId},id",
            'phone'  => "digits_between:10,13|unique:contacts,phone,{$contactId},id",
            'city'   => 'required|max:255|min:2',
            'metro'  => 'max:255|min:4',
            'age'    => "digits_between:1,2",
        ];
    }

}
