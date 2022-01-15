<?php

use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/grid', function (req $request) {
    $todos = $request->session()->get('todos');

    return view('grid', ['todos' => $todos, 'user' => Auth::user()]);
});

Route::get('/', [TodosController::class, 'index']);

Route::get('details/{todo}', [TodosController::class, 'details'])->middleware('auth');

Route::post('store-data', [TodosController::class, 'store'])->middleware('auth');

Route::get('delete/{todo}/{redirectTo}', [TodosController::class, 'destroy'])->middleware('auth');

Route::get('edit/{todo}', [TodosController::class, 'edit'])->middleware('auth')->name('edit');

Route::post('edit/update', [TodosController::class, 'update'])->middleware('auth');
