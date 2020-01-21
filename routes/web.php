<?php



Route::get('/', function () {
    return view('index');
});

//Rotas dos usuarios
Route::get('/usuarios','ControladorUsuario@indexView');

//Rotas das profissões
Route::get('/profissao','ControladorProfissao@index');
Route::get('/profissao/novo','ControladorProfissao@create');
Route::post('/profissao','ControladorProfissao@store');
Route::get('/profissao/apagar/{id}','ControladorProfissao@destroy');
Route::get('/profissao/editar/{id}','ControladorProfissao@edit');
Route::post('/profissao/{id}','ControladorProfissao@update');


?>

