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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/sobrenos', function () {
    return view('sobrenos');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', 'Auth\AdminLoginController@index')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/novo', 'AdminController@cadastroAdmin');
    Route::post('/', 'AdminController@novoAdmin');

    Route::get('/principal', function () { return view('admin.home_principal'); })->middleware('auth:admin');
    Route::get('/users', function () { return view('admin.home_users'); })->middleware('auth:admin');

    Route::get('/banner', 'AdminController@indexBanners');
    Route::post('/banner', 'AdminController@novoBanner');
    Route::post('/banner/editar/{id}', 'AdminController@editarBanner');
    Route::get('/banner/apagar/{id}', 'AdminController@apagarBanner');

    Route::get('/post', 'AdminController@indexPosts');
    Route::post('/post', 'AdminController@novoPost');
    Route::post('/post/editar/{id}', 'AdminController@editarPost');
    Route::get('/post/apagar/{id}', 'AdminController@apagarPost');

    Route::get('/foto', 'AdminController@indexFotos');
    Route::post('/foto', 'AdminController@novaFoto');
    Route::post('/foto/editar/{id}', 'AdminController@editarFoto');
    Route::get('/foto/apagar/{id}', 'AdminController@apagarFoto');

    Route::group(['prefix' => 'colaborador'], function() {
        Route::get('/', 'AdminController@indexOutros');
        Route::post('/', 'AdminController@novoOutro');
        Route::get('/filtro', 'AdminController@filtroOutros');
        Route::post('/editar/{id}', 'AdminController@editarOutro');
        Route::get('/apagar/{id}', 'AdminController@apagarOutro');
        Route::post('/importarExcel', 'AdminController@importarOutroExcel');
    });

    Route::group(['prefix' => 'clientes'], function() {
        Route::get('/', 'AdminController@indexClientes');
        Route::get('/filtro', 'AdminController@filtroCliente');
    });
});


Route::group(['prefix' => 'outro'], function() {
    Route::get('/login', 'Auth\OutroLoginController@index')->name('outro.login');
    Route::post('/login', 'Auth\OutroLoginController@login')->name('outro.login.submit');
    Route::get('/', 'OutroController@index')->name('outro.dashboard');

    Route::get('/principal', function () { return view('outro.home_principal'); })->middleware('auth:outro');

    Route::get('/banner', 'OutroController@indexBanners');
    Route::post('/banner', 'OutroController@novoBanner');
    Route::post('/banner/editar/{id}', 'OutroController@editarBanner');
    Route::get('/banner/apagar/{id}', 'OutroController@apagarBanner');

    Route::get('/post', 'OutroController@indexPosts');
    Route::post('/post', 'OutroController@novoPost');
    Route::post('/post/editar/{id}', 'OutroController@editarPost');
    Route::get('/post/apagar/{id}', 'OutroController@apagarPost');

    Route::get('/foto', 'OutroController@indexFotos');
    Route::post('/foto', 'OutroController@novaFoto');
    Route::post('/foto/editar/{id}', 'OutroController@editarFoto');
    Route::get('/foto/apagar/{id}', 'OutroController@apagarFoto');
});
