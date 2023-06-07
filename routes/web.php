<?php

use App\Models\pelicula;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas para el admin
Route::get('/admin', function () {return view('admin.index'); });
Route::get('/mostrar', function () {return view('admin.mostrar'); });



//rutas para el admin - peliculas
//habilitar ruta pelicumas mas unir el controlador y con la funcion index
route::get('/admin/peliculas', [App\Http\Controllers\peliculacontroller::class,'index']);
route::get('/admin/peliculas/create', [App\Http\Controllers\peliculacontroller::class,'create']);
route::resource('/admin/peliculas',\App\Http\Controllers\peliculacontroller::class);


//rutas para el admin - iptvs
//habilitar ruta pelicumas mas unir el controlador y con la funcion index
route::get('/admin/iptvs', [App\Http\Controllers\IptvController::class,'index']);
route::get('/admin/iptvs/create', [App\Http\Controllers\IptvController::class,'create']);
route::resource('/admin/iptvs',\App\Http\Controllers\IptvController::class);
