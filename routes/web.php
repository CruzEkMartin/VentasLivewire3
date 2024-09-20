<?php

use App\Livewire\Home\Inicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Category\CategoryShow;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Category\CategoryComponent;
use App\Livewire\Product\ProductShow;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/inicio', Inicio::class)->name('inicio');
Route::get('/categorias', CategoryComponent::class)->name('categorias');
Route::get('/categorias/show/{category}', CategoryShow::class)->name('categorias.show');

Route::get('/productos', ProductComponent::class)->name('productos');
Route::get('/productos/show/{producto}', ProductShow::class)->name('productos.show');
