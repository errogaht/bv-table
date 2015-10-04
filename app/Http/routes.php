<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
use Carbon\Carbon;

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');




Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/date', function () {
        d(Carbon::createFromFormat('d.m.y', '31.07.15'));
    });
    Route::get('/admin', function () {
        return view('admin_template');
    });
    /* Парсим файл разделённый табами и создам Contact*/
    Route::get('/csv', function () {
        $file = base_path() . "/db.txt";
        $string = file_get_contents($file);
        $rows = explode("\n",$string);
        $keys = [
            'date', 'name', 'phone', 'email', 'city', 'metro', 'age',
            'how_long', 'preferred_date', 'about', 'user_text', 'status',
            'comment', 'from', 'call_date_text'
        ];
        $i = 0;
        foreach ($rows as $row) {
            $i++;
            if ($i == 1) continue;

            $d = explode("\t", $row);

            $keys = array_pad($keys, 26, 0);
            $d = array_pad($d, 26, 0);

            $d = array_combine($keys, $d);
            $d['region_text'] = 'Москва и МО';
            $d['user_id'] = 1;
            $d['status'] = mb_strtoupper(mb_substr($d['status'], 0, 1)) . mb_substr($d['status'], 1);
            if (empty($d['date'])) continue;
            $d['date'] = trim($d['date']);
            $d['date'] = trim($d['date'], "'");
            $d['date'] = trim($d['date'], '"');

            try {
                $a = $d['date'];
                $d['date'] = Carbon::createFromFormat('d.m.y', $d['date']);
                //d($a, $d['date']);


            } catch (Exception $e) {
                $d['date'] = null;
            }


            \App\Contact::create($d);

        }


        //return view('admin_template');
    });
    Route::resource('contact', 'ContactController');
    Route::get('/test', 'TestController@index');
    Route::get('/table', 'TableController@index');
    Route::get('/home', function () {

        /**
         * @link https://github.com/raveren/kint
         */
        d([1,2,3,4]);


        /**
         * @link http://image.intervention.io/use/url
         * @file config/imagecache.php
         */
        echo "<img src='/img/small/12.jpg'><br>";


        /**
         * @link http://laravelcollective.com/docs/5.1/html
         */
        echo Form::open(array('url' => 'foo/bar', 'method' => 'put'));
        echo Form::select('size', array('H' => 'Hare', 'K' => 'Krshna'), 'K');
        echo Form::close();


        /**
         * @link https://github.com/laracasts/flash
         */
        Flash::message('Welcome Aboard!');


        /**
         * Роли пользователей
         * @link https://github.com/efficiently/authority-controller
         */
        if (Authority::can('read', 'ModelName')) {
            echo "Hare Krshna ! You're autentificated!";
        }

        echo "Hey! you don't have rights!";
        return view('demo');
    });
    Route::resource('profile', 'ProfileController');
});


