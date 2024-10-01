<?php

use App\Livewire\Home\Inicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Category\CategoryShow;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Category\CategoryComponent;
use App\Livewire\Client\ClientComponent;
use App\Livewire\Client\ClientShow;
use App\Livewire\Product\ProductShow;
use App\Livewire\Sale\SaleCreate;
use App\Livewire\Sale\SaleList;
use App\Livewire\Sale\SaleShow;
use App\Livewire\User\UserComponent;
use App\Livewire\User\UserShow;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register'=>false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', Inicio::class)->name('home')->middleware(['auth']);
Route::get('/categorias', CategoryComponent::class)->name('categorias')->middleware(['auth']);
Route::get('/categorias/show/{category}', CategoryShow::class)->name('categorias.show')->middleware(['auth']);

Route::get('/productos', ProductComponent::class)->name('productos')->middleware(['auth']);
Route::get('/productos/show/{producto}', ProductShow::class)->name('productos.show')->middleware(['auth']);

Route::get('/usuarios', UserComponent::class)->name('usuarios')->middleware(['auth']);
Route::get('/usuarios/show/{usuario}', UserShow::class)->name('usuarios.show')->middleware(['auth']);

Route::get('/clientes', ClientComponent::class)->name('clientes')->middleware(['auth']);
Route::get('/clientes/show/{cliente}', ClientShow::class)->name('clientes.show')->middleware(['auth']);

Route::get('/ventas/crear', SaleCreate::class)->name('ventas.create')->middleware(['auth']);
Route::get('/ventas', SaleList::class)->name('ventas.list')->middleware(['auth']);
Route::get('/ventas/show/{sale}', SaleShow::class)->name('ventas.show')->middleware(['auth']);
