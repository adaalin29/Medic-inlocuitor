<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index');
Route::get('despre', 'IndexController@despre');
Route::get('servicii', 'IndexController@servicii');
Route::get('contact', 'ContactController@contact');
Route::get('termeni', 'IndexController@termeni');
Route::get('politica', 'IndexController@politica');
Route::get('cookie', 'IndexController@cookie');

// User
Route::get('cont', 'AccountController@cont');
Route::get('date', 'AccountController@date');
Route::get('beneficii', 'AccountController@beneficii');
Route::get('pachete', 'AccountController@pachete');
Route::get('concediu', 'AccountController@concediu');
Route::get('istoric', 'AccountController@istoric');

Route::post('send-message','ContactController@send_message');
Route::post('edit-cont','AccountController@edit_cont');
Route::post('concediu-medic','AccountController@concediu_medic');
Route::post('concediu-rezident','AccountController@concediu_rezident');
Route::post('cumpara-pachet','AccountController@cumpara_pachet');
Route::post('concediu-finalizat','AccountController@concediu_finalizat');
Route::post('disponibilitate-finalizata','AccountController@disponibilitate_finalizata');

// User posts

Route::post('register','AccountController@register');
Route::post('login','AccountController@login');
Route::post('modifica-parola','AccountController@modifica_parola');
Route::post('logout','AccountController@logout');
Route::post('delete','AccountController@delete');
Route::post('reinoieste','AccountController@reinoieste_abonament');

Route::post('send-order','PaymentController@sendOrder');

Route::post('/confirm-order', 'PaymentController@confirm_order');
Route::get('/confirm-order', 'PaymentController@confirm_order');
Route::get('return-order', 'AccountController@cont');

Route::get('/storage/thumb/{query}/{file?}', 'ThumbController@index')
    ->where([
        'query' => '[A-Za-z0-9\:\;\-]+',
        'file'  => '[A-Za-z0-9\/\.\-\_]+',
    ])
    ->name('thumb');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
