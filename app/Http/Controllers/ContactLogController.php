<?php namespace App\Http\Controllers;

use App\ContactLog;
use Illuminate\Http\Request;


class ContactLogController extends Controller
{
    /**
     * Cписок
     *
     * @param  int $contact_id
     * @return \Illuminate\Http\Response
     */
    public function index($contact_id)
    {
        $comments = \App\ContactLog::with('user')->where('contact_id', '=', $contact_id)->get()->sortByDesc('created_at');
        return view('comment/_list')->with([
            'comments' => $comments,
        ]);
    }


    /**
     * Форма добавления
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contact_id)
    {
        return view('comment/_form')->with([
            'contact_id' => $contact_id,
        ]);
    }


    /**
     * Добавить коммент
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $contact = \App\Contact::findOrFail($id);

        $data = $request->input();
        $validator = \Validator::make($data, $rules = self::getValidatorRules());
        if (!$validator->fails()) {
            $model = new ContactLog($request->input());
            $model->user_id = \Auth::getUser()->id;
            $model->contact_id = $contact->id;
            $model->save();
        }

        return redirect(route('contact.show', $contact));
    }


    /**
     * Правила для валидатора
     *
     * @return array
     */
    public static function getValidatorRules()
    {
        return [
            'comment' => 'required|max:1024|min:2',
        ];
    }
}
