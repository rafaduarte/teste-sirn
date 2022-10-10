<?php

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->namespace('Proedi')
        ->middleware('auth')
        ->group(function() {

/**
 * Route Revisão Proedi ADM 
 */
Route::delete('proedi/revisao/{id}', 'Analisys\RevisaoController@destroy')->name('revisao.proedi.destroy');
Route::put('proedi/revisao/permitir-editar/{id}', 'Analisys\RevisaoController@permitirEditar')->name('revisao.proedi.permitir.editar');
Route::put('proedi/revisao/retirar-editar/{id}', 'Analisys\RevisaoController@retirarEditar')->name('revisao.proedi.retirar.editar');
Route::any('proedi/revisao/search', 'Analisys\RevisaoController@search')->name('revisao.proedi.search');
Route::get('proedi/revisao/{id}', 'Analisys\RevisaoController@show')->name('proedi.revisao.show');
Route::get('proedi/revisao', 'Analisys\RevisaoController@index' )->name('revisao.proedi.index');

/**
 *  Route Concessão Proedi ADM
*/
Route::delete('proedi/concessao/{id}', 'Analisys\ConcessaoController@destroy')->name('concessao.proedi.destroy');
Route::get('proedi/concessao/{id}', 'Analisys\ConcessaoController@show')->name('concessao.proedi.show');
Route::put('proedi/concessao/permitir-editar/{id}', 'Analisys\ConcessaoController@permitirEditar')->name('concessao.proedi.permitir.editar');
Route::put('proedi/concessao/retirar-editar/{id}', 'Analisys\ConcessaoController@retirarEditar')->name('concessao.proedi.retirar.editar');
Route::any('proedi/concessao/search', 'Analisys\ConcessaoController@search')->name('concessao.proedi.search');
Route::get('proedi/concessao', 'Analisys\ConcessaoController@index')->name('concessao.proedi.index');
                
/**
 * Routes SEI PROEDI Interno
 */
Route::delete('sei/proedi/{id}', 'SeiProediController@destroy')->name('proedi.sei.destroy');
Route::any('sei/proedi/search', 'SeiProediController@search')->name('proedi.sei.search');
Route::post('sei/proedi', 'SeiProediController@store')->name('proedi.sei.store');
Route::get('sei/proedi/create', 'SeiProediController@create')->name('proedi.sei.create');
Route::get('sei/proedi', 'SeiProediController@index')->name('proedi.sei.index');

/**
 * Routes Proedi adm
 */
Route::get('proedi/proedi/create', 'ProediController@create')->name('proedi.create.proedi');
Route::get('proedi/proedi', 'ProediController@proedi')->name('proedi.proedi');
Route::delete('proedi/proedi/{id}', 'ProediController@destroy')->name('proedi.destroy.proedi');
Route::any('proedi/search', 'ProediController@search')->name('proedi.search');
Route::resource('proedi', 'ProediController');

/**
 * Proedi
 */
Route::get('myproedi/proedi', 'ProediTenantController@myProedi')->name('proedi.empresa.myproedi');
Route::get('empresa/proedi', 'ProediTenantController@index')->name('proedi.empresa.index');

/**
 * Relatório ADM 1º Trimestre
 */
Route::delete('relatorio/proedi/{id}', 'Analisys\RelatorioController@destroy')->name('relatorio.proedi.destroy');
Route::put('proedi/primeiro-relatorio/permitir-editar/{id}', 'Analisys\RelatorioController@permitirEditar')->name('primeiro.relatorio.proedi.permitir.editar');
Route::put('proedi/primeiro-relatorio/retirar-editar/{id}', 'Analisys\RelatorioController@retirarEditar')->name('primeiro.relatorio.proedi.retirar.editar');
Route::any('index/relatorio/search', 'Analisys\RelatorioController@search')->name('relatorio.proedi.search');
Route::get('relatorio/proedi/{id}', 'Analisys\RelatorioController@show')->name('relatorio.proedi.show');
Route::get('index/relatorio', 'Analisys\RelatorioController@index')->name('index.relatorio.proedi.index');

/**
 * Relatório ADM 2º Trimestre
 */
Route::delete('relatorio/proedi/second/{id}', 'Analisys\RelatorioSegundoTrimestreController@destroy')->name('relatorio.proedi.second.destroy');
Route::put('proedi/segundo-relatorio/permitir-editar/{id}', 'Analisys\RelatorioSegundoTrimestreController@permitirEditar')->name('segundo.relatorio.proedi.permitir.editar');
Route::put('proedi/segundo-relatorio/retirar-editar/{id}', 'Analisys\RelatorioSegundoTrimestreController@retirarEditar')->name('segundo.relatorio.proedi.retirar.editar');
Route::any('index/relatorio/second/search', 'Analisys\RelatorioSegundoTrimestreController@search')->name('relatorio.proedi.second.search');
Route::get('relatorio/proedi/second/{id}', 'Analisys\RelatorioSegundoTrimestreController@show')->name('relatorio.proedi.second.show');
//Route::get('index/relatorio', 'Analisys\RelatorioSegundoTrimestreController@index')->name('index.relatorio.proedi.index');

/**
 * Relatório ADM 3º Trimestre
 */
Route::delete('relatorio/proedi/third/{id}', 'Analisys\RelatorioTerceiroTrimestreController@destroy')->name('relatorio.proedi.third.destroy');
Route::put('proedi/terceiro-relatorio/permitir-editar/{id}', 'Analisys\RelatorioTerceiroTrimestreController@permitirEditar')->name('terceiro.relatorio.proedi.permitir.editar');
Route::put('proedi/terceiro-relatorio/retirar-editar/{id}', 'Analisys\RelatorioTerceiroTrimestreController@retirarEditar')->name('terceiro.relatorio.proedi.retirar.editar');
Route::any('index/relatorio/third/search', 'Analisys\RelatorioTerceiroTrimestreController@search')->name('relatorio.proedi.third.search');
Route::get('relatorio/proedi/third/{id}', 'Analisys\RelatorioTerceiroTrimestreController@show')->name('relatorio.proedi.third.show');
//Route::get('index/relatorio', 'Analisys\RelatorioSegundoTrimestreController@index')->name('index.relatorio.proedi.index');

/**
 * Relatório ADM 4º Trimestre
 */
Route::delete('relatorio/proedi/fourth/{id}', 'Analisys\RelatorioQuartoTrimestreController@destroy')->name('relatorio.proedi.fourth.destroy');
Route::put('proedi/quarto-relatorio/permitir-editar/{id}', 'Analisys\RelatorioQuartoTrimestreController@permitirEditar')->name('quarto.relatorio.proedi.permitir.editar');
Route::put('proedi/quarto-relatorio/retirar-editar/{id}', 'Analisys\RelatorioQuartoTrimestreController@retirarEditar')->name('quarto.relatorio.proedi.retirar.editar');
Route::any('index/relatorio/fourth/search', 'Analisys\RelatorioQuartoTrimestreController@search')->name('relatorio.proedi.fourth.search');
Route::get('relatorio/proedi/fourth/{id}', 'Analisys\RelatorioQuartoTrimestreController@show')->name('relatorio.proedi.fourth.show');
//Route::get('index/relatorio', 'Analisys\RelatorioSegundoTrimestreController@index')->name('index.relatorio.proedi.index');

/**
 * enviar Relatório do 1º trimestre
 */
Route::get('proedi/relatorio/pedir-edicao/{id}', 'EnviarRelatorioController@pedirEdicao')->name('proedi.relatorio.pedir.edicao');
Route::any('proedi/relatorio/search', 'EnviarRelatorioController@search')->name('proedi.relatorio.search');
Route::get('proedi/relatorio/edit/{id}', 'EnviarRelatorioController@edit')->name('proedi.relatorio.edit');
Route::post('proedi/relatorio', 'EnviarRelatorioController@store')->name('proedi.relatorio.store');
Route::put('proedi/relatorio/update/{id}', 'EnviarRelatorioController@update')->name('proedi.relatorio.update');
Route::get('proedi/relatorio/create', 'EnviarRelatorioController@create')->name('proedi.relatorio.create');
Route::get('proedi/relatorio/{file}/file', 'PedirConcessaoController@file')->name('proedi.relatorio.file');
Route::get('proedi/relatorio/{id}', 'EnviarRelatorioController@show')->name('proedi.relatorio.show');
Route::get('relatorio/proedi', 'EnviarRelatorioController@index')->name('proedi.relatorio.index');

/**
 * Envio Relatório do 2º trimestre
 */
Route::get('proedi/relatorio/second/pedir-edicao/{id}', 'RelatorioSegundoTrimestreController@pedirEdicao')->name('proedi.relatorio.pedir.edicao.segundo');
Route::put('proedi/relatorio/update/second/{id}', 'RelatorioSegundoTrimestreController@update')->name('proedi.relatorio.second.update');
Route::get('proedi/relatorio/second/edit/{id}', 'RelatorioSegundoTrimestreController@edit')->name('proedi.relatorio.second.edit');
Route::get('proedi/relatorio/second/{file}/file', 'PedirConcessaoController@file')->name('proedi.relatorio.second.file');
Route::get('proedi/relatorio/second/{id}', 'RelatorioSegundoTrimestreController@show')->name('proedi.relatorio.second.show');
Route::post('proedi/relatorio/second/store', 'RelatorioSegundoTrimestreController@store')->name('proedi.relatorio.second_store');
Route::get('relatorio/proedi/second', 'RelatorioSegundoTrimestreController@index')->name('proedi.relatorio.second.index');

/**
 * Envio Relatório do 3º trimestre
 */
Route::get('proedi/relatorio/third/pedir-edicao/{id}', 'RelatorioTerceiroTrimestreController@pedirEdicao')->name('proedi.relatorio.pedir.edicao.terceiro');
Route::put('proedi/relatorio/update/third/{id}', 'RelatorioTerceiroTrimestreController@update')->name('proedi.relatorio.third.update');
Route::get('proedi/relatorio/third/edit/{id}', 'RelatorioTerceiroTrimestreController@edit')->name('proedi.relatorio.third.edit');
Route::get('proedi/relatorio/third/{file}/file', 'PedirConcessaoController@file')->name('proedi.relatorio.third.file');
Route::get('proedi/relatorio/third/{id}', 'RelatorioTerceiroTrimestreController@show')->name('proedi.relatorio.third.show');
Route::post('proedi/relatorio/third/store', 'RelatorioTerceiroTrimestreController@store')->name('proedi.relatorio.third.store');
Route::get('relatorio/proedi/third', 'RelatorioTerceiroTrimestreController@index')->name('proedi.relatorio.third.index');

/**
 * Envio Relatório do 4º trimestre
 */
Route::get('proedi/relatorio/fourth/pedir-edicao/{id}', 'RelatorioQuartoTrimestreController@pedirEdicao')->name('proedi.relatorio.pedir.edicao.quarto');
Route::put('proedi/relatorio/update/fourth/{id}', 'RelatorioQuartoTrimestreController@update')->name('proedi.relatorio.fourth.update');
Route::get('proedi/relatorio/fourth/edit/{id}', 'RelatorioQuartoTrimestreController@edit')->name('proedi.relatorio.fourth.edit');
Route::get('proedi/relatorio/fourth/{file}/file', 'PedirConcessaoController@file')->name('proedi.relatorio.fourth.file');
Route::get('proedi/relatorio/fourth/{id}', 'RelatorioQuartoTrimestreController@show')->name('proedi.relatorio.fourth.show');
Route::post('proedi/relatorio/fourth/store', 'RelatorioQuartoTrimestreController@store')->name('proedi.relatorio.fourth.store');
Route::get('relatorio/proedi/fourth', 'RelatorioQuartoTrimestreController@index')->name('proedi.relatorio.fourth.index');

/**
 * Pedir Revisão
 */
Route::get('revisao/proedi/pedir-edicao/{id}', 'PedirRevisaoController@pedirEdicao')->name('proedi.revisao.pedir.edicao');
Route::get('revisao/proedi/{file}/file', 'PedirRevisaoController@index')->name('proedi.revisao.file');
Route::get('revisao/proedi/edit/{id}', 'PedirRevisaoController@edit')->name('revisao.proedi.edit');
Route::any('revisao/proedi/search', 'PedirRevisaoController@search')->name('proedi.revisao.search');
Route::put('revisao/proedi/update/{id}', 'PedirRevisaoController@update')->name('revisao.proedi.update');
Route::post('revisao/proedi', 'PedirRevisaoController@store')->name('proedi.revisao.store');
Route::get('revisao/proedi/create', 'PedirRevisaoController@create')->name('proedi.revisao.create');
Route::get('revisao/proedi/{id}', 'PedirRevisaoController@show')->name('revisao.proedi.show');
Route::get('revisao/proedi', 'PedirRevisaoController@index')->name('proedi.revisao.index');

/**
 * Pedir concessão
 */
Route::get('concessao/proedi/pedir-edicao/{id}', 'PedirConcessaoController@pedirEdicao')->name('proedi.concessao.pedir.edicao');
Route::get('concessao/proedi/{file}/file', 'PedirConcessaoController@file')->name('proedi.concessao.file');
Route::get('concessao/proedi/edit/{id}', 'PedirConcessaoController@edit')->name('proedi.concessao.edit');
Route::any('concessao/proedi/search', 'PedirConcessaoController@search')->name('proedi.concessao.search');
Route::get('concessao/proedi/create', 'PedirConcessaoController@create')->name('proedi.concessao.create');
Route::put('concessao/proedi/update/{id}', 'PedirConcessaoController@update')->name('proedi.concessao.update');
Route::post('concessao/proedi', 'PedirConcessaoController@store')->name('proedi.concessao.store');
Route::get('concessao/proedi/{id}', 'PedirConcessaoController@show')->name('proedi.concessao.show');
Route::get('concessao/proedi', 'PedirConcessaoController@index')->name('proedi.concessao.index');


/**
 *  Requerimento Concessão PROEDI
 */
Route::post('requerimento/proedi', 'RequerimentoProediController@donwload')->name('requerimento.proedi.download');

/**
 *  Requerimento Revisão PROEDI
 */

Route::post('requerimento/revisaoo/proedi', 'RequerimentoRevisaoProediController@donwload')->name('requerimento.revisao.proedi.download');

});

Route::prefix('admin')
        ->namespace('Rngas')
        ->middleware('auth')
        ->group(function() {

/**
 * RN Mais Gás
 */
Route::get('meu/rngas', 'RngasController@index')->name('rngas.meurngas');
Route::get('empresa/rngas', 'RngasController@create')->name('rngas.empresa.index');

/**
 *  Admin RN Mais Gás  
 */
Route::delete('rngas/{id}', 'Analisys\RngasController@destroy')->name('rngas.destroy');
Route::post('store/rngas/store', 'Analisys\RngasController@store')->name('rngas.store');
Route::get('rngas/create', 'Analisys\RngasController@create')->name('rngas.create');
Route::get('rngas', 'Analisys\RngasController@index')->name('rngas.index');

/**
 * Pedir Concessão RN Gás+ 
 */
Route::get('concessao/rngas/pedir-edicao/{id}', 'ConcessaoController@Edicao')->name('rngas.concessao.pedir.edicao');
Route::get('concessao/rngas/{file}/file', 'ConcessaoController@file')->name('rngas.concessao.file');
Route::get('concessao/rngas/edit/{id}', 'ConcessaoController@edit')->name('rngas.concessao.edit');
Route::any('concessao/rngas/search', 'ConcessaoController@search')->name('rngas.concessao.search');
Route::get('concessao/rngas/create/three', 'ConcessaoController@createThree')->name('rngas.concessao.create.three');
Route::get('concessao/rngas/create/two', 'ConcessaoController@createTwo')->name('rngas.concessao.create.two');
Route::get('concessao/rngas/create', 'ConcessaoController@create')->name('rngas.concessao.create');
Route::put('concessao/rngas/update/{id}', 'ConcessaoController@update')->name('rngas.concessao.update');
Route::post('concessao/rngas/all', 'ConcessaoController@storeAll')->name('rngas.concessao.store.all');
Route::post('concessao/rngas/three', 'ConcessaoController@storeThree')->name('rngas.concessao.store.three');
Route::post('concessao/rngas/two', 'ConcessaoController@storeTwo')->name('rngas.concessao.store.two');
Route::post('concessao/rngas', 'ConcessaoController@store')->name('rngas.concessao.store');
Route::get('concessao/rngas/{id}', 'ConcessaoController@show')->name('rngas.concessao.show');
Route::get('concessao/rngas', 'ConcessaoController@index')->name('rngas.concessao.index');

/**
 *  Atualizar Pedido de Concessão RN Mais Gás
 */
Route::post('atualizar/rngas/three', 'ConcessaoController@updateThree')->name('rngas.atualizar.three');
Route::post('atualizar/rngas/two', 'ConcessaoController@updateTwo')->name('rngas.atualizar.two');
Route::post('atualizar/rngas', 'ConcessaoController@updateOne')->name('rngas.atualizar');
Route::get('atualizar/rngas/{id}', 'ConcessaoController@pedirEdicao')->name('rngas.pedir.atualizar');

/**
 * Routes SEI RN Mais Gás Interno
 */
Route::delete('sei/rngas/{id}', 'Analisys\SeiRnGasController@destroy')->name('rngas.sei.destroy');
Route::any('sei/rngas/search', 'Analisys\SeiRnGasController@search')->name('rngas.sei.search');
Route::post('sei/rngas', 'Analisys\SeiRnGasController@store')->name('rngas.sei.store');
Route::get('sei/rngas/create', 'Analisys\SeiRnGasController@create')->name('rngas.sei.create');
Route::get('sei/rngas', 'Analisys\SeiRnGasController@index')->name('rngas.sei.index');

/**
 * Routes SEI RN Mais Gás Externo
 */
Route::delete('sei/rngas/externo/{id}', 'SeiRnGasController@destroy')->name('tenant.rngas.sei.destroy');
Route::any('sei/rngas/externo/search', 'SeiRnGasController@search')->name('tenant.rngas.sei.search');
Route::post('sei/rngas/externo', 'SeiRnGasController@store')->name('tenant.rngas.sei.store');
Route::get('sei/rngas/externo/create', 'SeiRnGasController@create')->name('tenant.rngas.sei.create');
Route::get('sei/rngas/externo', 'SeiRnGasController@index')->name('tenant.rngas.sei.index');

/**
 *  Requerimento Concessão PROEDI
 */
Route::post('requerimento/rngas', 'RequerimentoRngasController@donwload')->name('requerimento.rngas.download');

/**
 *  Admin Menu RN Mais Gás
 */
Route::get('menu/rngas', 'Analisys\MenuController@index')->name('menu.rngas.admin');

/**
 *  Admin RN Mais Gás Concessão
 */
Route::delete('rngas/concessao/{id}', 'Analisys\ConcessaoController@destroy')->name('delete.rngas.admin');
Route::get('rngas/concessao/{id}', 'Analisys\ConcessaoController@show')->name('show.rngas.admin');
Route::put('rngas/concessao/permitir-editar/{id}', 'Analisys\ConcessaoController@permitirEditar')->name('concessao.rngas.permitir.editar');
Route::put('rngas/concessao/retirar-editar/{id}', 'Analisys\ConcessaoController@retirarEditar')->name('concessao.rngas.retirar.editar');
Route::any('rngas/concessao/search', 'Analisys\ConcessaoController@search')->name('concessao.rngas.search');
Route::get('rngas/index', 'Analisys\ConcessaoController@index')->name('index.rngas.admin');
Route::get('rngas/index/menu', 'Analisys\MenuController@index')->name('index.rngas.admin.menu');

/**
 *  Route Concessão Proedi ADM
*/
Route::delete('proedi/concessao/{id}', 'Analisys\ConcessaoController@destroy')->name('concessao.proedi.destroy');
Route::get('proedi/concessao/{id}', 'Analisys\ConcessaoController@show')->name('concessao.proedi.show');
Route::put('proedi/concessao/permitir-editar/{id}', 'Analisys\ConcessaoController@permitirEditar')->name('concessao.proedi.permitir.editar');
Route::put('proedi/concessao/retirar-editar/{id}', 'Analisys\ConcessaoController@retirarEditar')->name('concessao.proedi.retirar.editar');
Route::any('proedi/concessao/search', 'Analisys\ConcessaoController@search')->name('concessao.proedi.search');
Route::get('proedi/concessao', 'Analisys\ConcessaoController@index')->name('concessao.proedi.index');

/**
 *  Tenant Menu RN Mais Gás
 */
Route::get('menu/rngas/tenant', 'MenuController@index')->name('menu.rngas.tenant');

});

Route::prefix('admin')
        ->namespace('Mensagens')
        ->middleware('auth')
        ->group(function() {

/**
 *  admin mensagens
 */

Route::get('mensagem/create', 'adminMensagensController@create')->name('admin.mensagem.create');
Route::delete('mensagem/{id}', 'adminMensagensController@destroy')->name('admin.mensagem.destroy');
Route::get('mensagem/sent', 'adminMensagensController@sent')->name('admin.mensagem.sent');
Route::get('mensagem/{id}', 'adminMensagensController@show')->name('admin.mensagem.show');
Route::post('mensagem', 'adminMensagensController@store')->name('admin.mensagem.store');
Route::get('mensagem', 'adminMensagensController@index')->name('admin.mensagem.index');

/**
 *  tenant mensagens
 */
Route::get('tenant/mensagem/create', 'tenantMensagensController@create')->name('tenant.mensagem.create');
Route::delete('tenant/mensagem/{id}', 'tenantMensagensController@destroy')->name('tenant.mensagem.destroy');
Route::get('tenant/mensagem/sent', 'tenantMensagensController@sent')->name('tenant.mensagem.sent');
Route::get('tenant/mensagem/{id}', 'tenantMensagensController@show')->name('tenant.mensagem.show');
Route::post('tenant/mensagem', 'tenantMensagensController@store')->name('tenant.mensagem.store');
Route::get('tenant/mensagem', 'tenantMensagensController@index')->name('tenant.mensagem.index');
       

});


Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function() {

/**
 * report PROEDI
 */
Route::get('reports/proedi/report', 'ACL\ReportsProediController@report')->name('reports.proedi.report');
Route::get('reports/proedi/trimestre/excel', 'ACL\ReportsProediController@trimestreExcel')->name('reports.proedi.trimestre.excel');
Route::get('reports/proedi/fourth/trimestre', 'ACL\ReportsProediController@quarto_trimestre')->name('reports.proedi.fourth.trimestre');
Route::get('reports/proedi/third/trimestre', 'ACL\ReportsProediController@terceiro_trimestre')->name('reports.proedi.third.trimestre');
Route::get('reports/proedi/second/trimestre', 'ACL\ReportsProediController@segundo_trimestre')->name('reports.proedi.second.trimestre');
Route::get('reports/proedi/trimestre', 'ACL\ReportsProediController@trimestre')->name('reports.proedi.trimestre');
Route::get('reports/proedi/empresas', 'ACL\ReportsProediController@empresas')->name('reports.proedi.empresas');
Route::get('reports/proedi', 'ACL\ReportsProediController@index')->name('reports.proedi.index');

/**
 * report RN Mais Gás
 */
Route::get('reports/rngas/report', 'ACL\ReportsRngasController@report')->name('reports.rngas.report');
Route::get('reports/rngas/trimestre/excel', 'ACL\ReportsRngasController@trimestreExcel')->name('reports.rngas.trimestre.excel');
Route::get('reports/rngas/trimestre', 'ACL\ReportsRngasController@especifico')->name('reports.rngas.especifico');
Route::get('reports/rngas/empresas', 'ACL\ReportsRngasController@geral')->name('reports.rngas.geral');
Route::get('reports/rngas', 'ACL\ReportsRngasController@index')->name('reports.rngas.index');

/**
 * report
 */
Route::get('reports', 'ACL\ReportsController@index')->name('reports.index');

/**
 * Profile x User
 */
    Route::get('users/{id}/role/{idRole}/detach', 'ACL\UserProfileController@detachProfileUser')->name('users.profile.detach');
    Route::post('users/{id}/profiles', 'ACL\UserProfileController@attachProfilesUser')->name('users.profiles.attach');
    Route::any('users/{id}/profiles/create', 'ACL\UserProfileController@profilesAvailable')->name('users.profiles.available');
    Route::get('users/{id}/profiles', 'ACL\UserProfileController@profiles')->name('users.profiles');
    Route::get('profiles/{id}/users', 'ACL\UserProfileController@users')->name('profiles.users');

/**
 * Permission x Profile
 */
Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsAvailable')->name('profiles.permissions.attach');
Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

/**
 * Routes Profiles
 */
Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
Route::resource('profiles', 'ACL\ProfileController');

/**
 * Routes Permissions
 */
Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
Route::resource('permissions', 'ACL\PermissionController');

/**
 * Routes Users
 */
//Route::any('users/search', 'UserController@search')->name('users.search');
Route::resource('users', 'UserController');

/**
 * Routes Users edit tenant
 */
Route::get('users/pedir-editar/{id}', 'UserController@pedirEdicao')->name('user.pedir.editar');
Route::put('users/retirar-editar/{id}', 'UserController@retirarEditar')->name('user.retirar.editar');
Route::put('users/permitir-editar/{id}', 'UserController@permitirEditar')->name('user.permitir.editar');
Route::put('users/update-datas/{id}', 'UserController@updateDatas')->name('user.update.data');
Route::get('users/edit-datas/{id}', 'UserController@editDatas')->name('user.edit.data');
Route::get('users/index/tenant', 'UserController@indexTenant')->name('user.index.tenants');



});

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@home')->name('site');

Route::get('/home', 'HomeController@index')->name('home');
