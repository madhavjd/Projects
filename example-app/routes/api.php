<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('branch', [App\Http\Controllers\BranchController::class, 'getbranch']);
Route::get('deletebranchdata/{id}', [App\Http\Controllers\BranchController::class, 'destroy']);
Route::patch('editbranchdata/{id}', [App\Http\Controllers\BranchController::class, 'edit']);
Route::post('updatebranchdata/{id}', [App\Http\Controllers\BranchController::class, 'update']);
Route::post('savebranchdata', [App\Http\Controllers\BranchController::class, 'store']);
Route::get('todolistget', [App\Http\Controllers\TodolistController::class, 'index']);
Route::get('deletetodolist/{id}', [App\Http\Controllers\TodolistController::class, 'destroy']);
Route::post('todolist', [App\Http\Controllers\TodolistController::class, 'store']);
Route::patch('todolist/{id}', [App\Http\Controllers\TodolistController::class, 'edit']);
Route::any('updatetodo/{id}', [App\Http\Controllers\TodolistController::class, 'update']);
Route::get('allemployee', [App\Http\Controllers\EmployeeController::class, 'index']);
Route::post('saveallemployee', [App\Http\Controllers\EmployeeController::class, 'store']);
Route::patch('editallemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'edit']);
Route::post('updateallemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'update']);
Route::get('deleteallemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy']);
// Verb          Path                        Action  Route Name
// GET           /users                      index   users.index
// GET           /users/create               create  users.create
// POST          /users                      store   users.store
// GET           /users/{user}               show    users.show
// GET           /users/{user}/edit          edit    users.edit
// PUT|PATCH     /users/{user}               update  users.update
// DELETE        /users/{user}               destroy users.destroy