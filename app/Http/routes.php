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

Route::get('/', function () {
    return view('site.principal');
});


Route::get('venda',[
    'uses' => 'SiteController@cotacao',
    'as' => 'venda'
]);


Route::post('salvar-cotacao', 'SiteController@salvarCotacao');
Route::post('salvar-agendamento', 'SiteController@salvarAgendamento');

Route::get('listagem-veiculos', 'SiteController@listarVeiculos');

Route::get('/email',[
    'uses' => 'SiteController@sendEmailTest'

]);