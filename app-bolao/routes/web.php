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

Route::get('/modelo', function () {
    
    return view('welcome');
});

Auth::routes();

/* Site */
Route::namespace('Site')->group(function () {
    Route::get('/', 'PrincipalController@index')->name('principal');
});

/* Área admin dos usuários do site */
Route::middleware('auth')->namespace('Admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

/* Área admin do sistema */
Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {
    
    /* Users */
    Route::resource('/users', 'UserController');

    /* Bettings */
    Route::resource('/bettings', 'BettingController');

    /* Rounds */
    Route::resource('/rounds', 'RoundController');

    /* Matches */
    Route::resource('/matches', 'MatchesController');
});

Route::prefix('admin')->middleware(['auth', 'can:acl'])->namespace('Admin')->group(function () {
    
    /* Permissions */
    Route::resource('/permissions', 'PermissionController');

    /* Roles */
    Route::resource('/roles', 'RoleController');
});
