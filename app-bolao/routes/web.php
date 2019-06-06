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

Route::get('lang', function () {
    $lang = session('lang', 'pt-br');
    if($lang == 'pt-br'){
        $lang = "en";
        
    }else{
        $lang = "pt-br";
    }
    session(['lang' => $lang]);
    return redirect()->back();
    
})->name('lang');

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {
    
    /* Users */
    Route::resource('/users', 'UserController');
    
    Route::get('/users', 'UserController@index')
        ->name('users.index')
        ->middleware('can:list-users');

    Route::get('/users/create', 'UserController@create')
        ->name('users.create')
        ->middleware('can:create-user');
    
    Route::post('/users', 'UserController@store')
        ->name('users.store')
        ->middleware('can:create-user');
    
    /* Permissions */
    Route::resource('/permissions', 'PermissionController');

    /* Roles */
    Route::resource('/roles', 'RoleController');
});
