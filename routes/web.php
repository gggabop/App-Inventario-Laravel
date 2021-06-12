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

Route::get('/', function () {
    return view('plantilla');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//RUTAS QUE INCLUYEN TODOS LOS MÉTODOS HTTP
//Route::resource
//php artisan route:list

Route::resource('/', 'BlogController');
Route::resource('/blog', 'BlogController');
Route::resource('/administradores', 'AdministradoresController');
Route::resource('/distribuidores', 'DistribuidoresController');
Route::resource('/productos', 'ProductosController');
Route::resource('/entregas', 'EntregasController');
Route::get('/backup', 'TaskController@index');
Route::resource('/salidas', 'SalidasController');
Route::resource('/reportes', 'PdfController');
Route::post('/salidas/all', 'SalidasController@all');
Route::get('/backup/respaldo', 'TaskController@create');
Route::get('/backup/descarga/{file_name}', 'TaskController@download');
Route::get('/backup/elimina/{file_name}', 'TaskController@delete');
Route::get('/productosPDF', 'PdfController@PDFproductos');
Route::get('/administradoresPDF', 'PdfController@PDFadministradores');
Route::get('/distribuidoresPDF', 'PdfController@PDFdistribuidores');
Route::get('/entregasPDF', 'PdfController@PDFentregas');
Route::get('/salidasPDF', 'PdfController@PDFsalidas');




