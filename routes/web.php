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

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/
Route::get('client/deleteClient', [ClientController::class, 'destroy'])->name('client.delete');
Route::get('client/softDeleted', [ClientController::class, 'softDeletedClients']);
Route::get('client/forceDelete', [ClientController::class, 'forceDeleteSoftDeletedClients']);
Route::resource('client',ClientController::class);

/*
|--------------------------------------------------------------------------
| Project Routes
|--------------------------------------------------------------------------
*/
Route::get('project/softDeleted', [ProjectController::class, 'softDeletedProjects']);
Route::get('project/forceDelete', [ProjectController::class, 'forceDeleteSoftDeletedProjects']);
Route::resource('project',ProjectController::class);

/*
|--------------------------------------------------------------------------
| Task Routes
|--------------------------------------------------------------------------
*/
Route::get('task/softDeleted', [TaskController::class, 'softDeletedTasks']);
Route::get('task/forceDelete', [TaskController::class, 'forceDeleteSoftDeletedTasks']);
Route::resource('task',TaskController::class);


Route::get('/dashboard', function () {
    return view('dashboard.home');
});
