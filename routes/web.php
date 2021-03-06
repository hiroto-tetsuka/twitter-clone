<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'TasksController@index')->name('login');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    // Route::resource('tasks', 'TasksController');

    Route::get('/tasks', 'TasksController@index')->name('tasks.index');
    Route::get('/tasks/create', 'TasksController@create');
    Route::post('/tasks/store', 'TasksController@store')->name('tasks.store');
    Route::get('/tasks/show/{id}', 'TasksController@show')->name('tasks.show');
    Route::get('/tasks/edit/{id}', 'TasksController@edit')->name('tasks.edit');
    Route::put('/tasks/update/{id}', 'TasksController@update')->name('tasks.update');
    Route::get('/tasks/destroy/{id}', 'TasksController@destroy')->name('tasks.destroy');
    
});