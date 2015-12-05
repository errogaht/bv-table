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
            'contacts' => \App\Contact::all()->sortByDesc('created_at')
        ]);
    }


    /**
     * Список моих контактов
     */
    public function userList($user_id)
    {
        $user = \App\User::findOrFail($user_id);
        return view('contact/index')->with([
            'page_title' => 'Контакты - '.$user->name,
            'contacts' => \App\Contact::where('taken_by', '=', intval($user_id))->orderBy('status')->get()
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
        $contact = new \App\Contact($request->input());
        $validator = \Validator::make($contact->getAttributes(), $rules = self::getValidatorRules());
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $contact->created_by = \Auth::getUser()->id;
        $contact->save();
        Flash::success('Контакт успешно добавлен');

        return redirect(route('contact.show', $contact));
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
            'contact'    => $contact,
            'user'       => \Auth::getUser(),
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
        /** @var Contact $contact */
        $contact = Contact::findOrFail($id);
        $contact->fill($request->all());
        $validator = \Validator::make($contact->getAttributes(), $rules = self::getValidatorRules($contact->id));
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $contact->save();
        Flash::success('Контакт успешно обновлён');

        return redirect(route('contact.show', $contact));
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


    /**
     * Изменить Статус
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     * @param                          $status
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function status(Request $request, $id, $status)
    {
        /** @var Contact $contact */
        $contact = Contact::findOrFail($id);

        // TODO: проверка, что пользователю разрешен перевод в выбранный статус
        if ($contact->status != $status) {
            $contact->status = $status;
            $contact->change_status_comment = $request->get('comment');
            switch ($status) {
                case \App\Contact::STATUS_WORK:
                case \App\Contact::STATUS_SUCCESS:
                    $contact->taken_by = \Auth::getUser()->id;
                    $contact->taken_at = new \DateTime();
                    break;
                case \App\Contact::STATUS_FAIL:
                    if (!$contact->change_status_comment) {
                        Flash::error('Укажите причину отказа');
                        goto redirect;
                    }
                    //break;
                case \App\Contact::STATUS_NEW:
                    $contact->taken_by = null;
                    $contact->taken_at = null;
                    break;
                default:
                    goto redirect;
            }

            $contact->save();
        }

        redirect:
        return redirect(route('contact.show', $contact));
    }
}
