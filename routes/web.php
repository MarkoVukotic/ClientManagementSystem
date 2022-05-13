<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\{
    ClientController,
    ProjectController,
    TaskController,
};

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

Route::get('client/softDeleted', [ClientController::class, 'softDeletedClients']);
Route::get('client/forceDelete', [ClientController::class, 'forceDeleteSoftDeletedClients']);
Route::resource('client',ClientController::class);
Route::resource('project',ProjectController::class);
Route::resource('task',TaskController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
});
