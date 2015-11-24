<?php


Route::get('auth/logout', ['as' => 'auth.logout', 'uses'=>'Auth\AuthController@getLogout']);
Route::group(['prefix' => 'auth', 'as'=>'auth.', 'middleware' => 'is_authenticated'], function () {
    // Authentication routes...
    Route::get('login',  ['as' => 'login', 'uses'=>'Auth\AuthController@getLogin']);
    Route::post('login', ['as' => 'login', 'uses'=>'Auth\AuthController@postLogin']);
    // Registration routes...
    Route::get('register', ['as' => 'register', 'uses'=>'Auth\AuthController@getRegister']);
    Route::post('register', ['as' => 'register', 'uses'=>'Auth\AuthController@postRegister']);
});


Route::group(['middleware' => 'auth'], function () {

    // Главная
    Route::get('/', function () {
        return redirect('profile');
    });

    // Зарегистирированные пользователи
    Route::resource('user', '\App\Http\Controllers\UserController',
        ['only' => ['index', 'show']]
    );

    // Профиль пользователя
    Route::get('profile', ['as' => 'profile', 'uses' => '\App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile', 'uses' => '\App\Http\Controllers\ProfileController@update']);

    // Контакты
    Route::resource('contact', 'ContactController');
    // Статусы
    Route::put('contact/{id}/status/{status}', ['as' => 'contact.status', 'uses' => '\App\Http\Controllers\ContactController@status']);

    // Комментарий
    Route::post('contact/{id}/log', ['as' => 'contact_log.store', 'uses' => '\App\Http\Controllers\ContactLogController@store']);
});


