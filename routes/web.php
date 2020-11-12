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
Route::get('/promocoes', 'IndexController@promocoes')->name('promocoes');
Route::get('/produtos', 'IndexController@produtos')->name('produtos');
Route::get('/busca', 'IndexController@buscar');

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
    Route::post('/novo', 'AdminController@novoAdmin');

    Route::get('/principal', function () { return view('admin.home_principal'); })->middleware('auth:admin');
    Route::get('/users', function () { return view('admin.home_users'); })->middleware('auth:admin');
    Route::get('/recibos', function () { return view('admin.home_recibos'); })->middleware('auth:admin');

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

    Route::get('/cadastros', 'AdminController@cadastros');

    Route::group(['prefix' => 'categorias'], function() {
        Route::get('/', 'AdminController@indexCategorias');
        Route::post('/', 'AdminController@novaCategoria');
        Route::post('/editar/{id}', 'AdminController@editarCategoria');
        Route::get('/apagar/{id}', 'AdminController@inativarCategoria');
    });

    Route::group(['prefix' => 'cuponsDesconto'], function() {
        Route::get('/', 'AdminController@indexCupons');
        Route::post('/', 'AdminController@novoCupom');
        Route::post('/editar/{id}', 'AdminController@editarCupom');
        Route::get('/apagar/{id}', 'AdminController@inativarCupom');
    });

    Route::group(['prefix' => 'entregas'], function() {
        Route::get('/', 'AdminController@indexEntregas');
        Route::post('/', 'AdminController@novaEntrega');
        Route::post('/editar/{id}', 'AdminController@editarEntrega');
        Route::get('/apagar/{id}', 'AdminController@inativarEntrega');
    });

    Route::group(['prefix' => 'formasPagamento'], function() {
        Route::get('/', 'AdminController@indexFormas');
        Route::post('/', 'AdminController@novaForma');
        Route::post('/editar/{id}', 'AdminController@editarForma');
        Route::get('/apagar/{id}', 'AdminController@inativarForma');
    });

    Route::group(['prefix' => 'produtos'], function() {
        Route::get('/', 'AdminController@indexProdutos');
        Route::post('/', 'AdminController@novoProduto');
        Route::post('/editar/{id}', 'AdminController@editarProduto');
        Route::get('/apagar/{id}', 'AdminController@inativarProduto');
        Route::get('/filtro', 'AdminController@filtroProduto');
    });

    Route::group(['prefix' => 'anuncios'], function() {
        Route::get('/', 'AdminController@indexAnuncios');
        Route::post('/', 'AdminController@novoAnuncio');
        Route::post('/editar/{id}', 'AdminController@editarAnuncio');
        Route::get('/apagar/{id}', 'AdminController@apagarAnuncio');
    });

    Route::group(['prefix' => 'pedidos'], function() {
        Route::get('/', 'AdminController@pedidos');
        Route::get('/feitos', 'AdminController@pedidos_feitos');
        Route::get('/pagos', 'AdminController@pedidos_pagos');
        Route::get('/cancelados', 'AdminController@pedidos_cancelados');
        Route::get('/reservados', 'AdminController@pedidos_reservados');
        Route::get('/reservados/liberar/{id}', 'AdminController@liberar_produto_reservado');
        Route::get('/pagar/{id}', 'AdminController@pagar_pedido');
        Route::get('/cancelar/{id}', 'AdminController@cancelar_pedido');
    });

    Route::group(['prefix' => 'estoque'], function() {
        Route::get('/', 'AdminController@indexEstoque');
        Route::get('/filtro', 'AdminController@filtroEstoque');
        Route::post('/entrada/{id}', 'AdminController@entrada');
        Route::post('/saida/{id}', 'AdminController@saida');
    });

    Route::group(['prefix' => 'compraLivro'], function() {
        Route::get('/', 'AdminController@indexCompraLivros');
        Route::post('/', 'AdminController@novaCompraLivro');
        Route::get('/pdf/{id}', 'AdminController@gerarRecibo');
        Route::get('/filtro', 'AdminController@filtroCompraLivro');
        Route::post('/editar/{id}', 'AdminController@editarCompraLivro');
        Route::get('/apagar/{id}', 'AdminController@apagarCompraLivro');
        Route::post('/relatorio', 'AdminController@gerarPdfRelatorio');
    });

    Route::group(['prefix' => 'relatorios'], function() {
        Route::get('/', 'AdminController@indexRelatorios');
        Route::get('/estoque', 'AdminController@relatorioEstoque');
        Route::get('/estoque/filtro', 'AdminController@relatorioEstoqueFiltro');
        Route::get('/vendas', 'AdminController@indexVendas');
        Route::get('/vendas/produtos', 'AdminController@vendasProdutos');
        Route::get('/vendas/produtos/filtro', 'AdminController@vendasProdutosFiltro');
        Route::get('/vendas/clientes', 'AdminController@vendasClientes');
        Route::get('/vendas/clientes/filtro', 'AdminController@vendasClientesFiltro');
        Route::get('/vendas/clientesProdutos', 'AdminController@vendasClientesProdutos');
        Route::get('/vendas/clientesProdutos/filtro', 'AdminController@vendasClientesProdutosFiltro');
    });

});


Route::group(['prefix' => 'outro'], function() {
    Route::get('/login', 'Auth\OutroLoginController@index')->name('outro.login');
    Route::post('/login', 'Auth\OutroLoginController@login')->name('outro.login.submit');
    Route::get('/', 'OutroController@index')->name('outro.dashboard');

    Route::get('/principal', function () { return view('outro.home_principal'); })->middleware('auth:outro');
    Route::get('/recibos', function () { return view('outro.home_recibos'); })->middleware('auth:outro');

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

    Route::group(['prefix' => 'compraLivro'], function() {
        Route::get('/', 'OutroController@indexCompraLivros');
        Route::post('/', 'OutroController@novaCompraLivro');
        Route::get('/pdf/{id}', 'OutroController@gerarRecibo');
        Route::get('/filtro', 'OutroController@filtroCompraLivro');
    });
});

Route::get('/compras', function() {
    return view("cliente.home_compras");
})->middleware("auth");
Route::get('/enderecos', 'UserController@indexEnderecos');
Route::post('/enderecos', 'UserController@novoEndereco');
Route::get('/enderecos/apagar/{id}', 'UserController@inativarEndereco');
Route::get('/telefones', 'UserController@indexTelefones');
Route::post('/telefones', 'UserController@novoTelefone');
Route::get('/telefones/apagar/{id}', 'UserController@inativarTelefone');
Route::get('/produto/{id}', 'HomeController@produto')->name('produto');
Route::get('/carrinho', 'UserController@index')->name('carrinho.index');
Route::get('/carrinho/adicionar', function() {
    return redirect()->route('index');
});
Route::post('/carrinho/adicionar', 'UserController@adicionar')->name('carrinho.adicionar');
Route::delete('/carrinho/remover', 'UserController@remover')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'UserController@concluir')->name('carrinho.concluir');
Route::get('/carrinho/compras', 'UserController@compras')->name('carrinho.compras');
Route::get('/carrinho/canceladas', 'UserController@canceladas')->name('carrinho.canceladas');
Route::post('/carrinho/cancelar', 'UserController@cancelar')->name('carrinho.cancelar');
Route::post('/carrinho/desconto', 'UserController@desconto')->name('carrinho.desconto');
