<?php

use Illuminate\Support\Facades\Route;
use App\Models\employee;

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
// Route::view('/productpage',"allproducts");
// Route::get('/productpage', [App\Http\Controllers\HomeController::class, 'getallproducts']);
Route::get('/productpage', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/addnewprod', [App\Http\Controllers\ProductController::class, 'create']);
Route::post('/saveproddata', [App\Http\Controllers\ProductController::class, 'store']);
Route::view('/admindashboard',"admin.admindashboard");
Route::any('/adminallproducts', [App\Http\Controllers\ProductController::class, 'adminallproducts']);
Route::any('/productdelete/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('/productedit/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/productedit/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::any('/branch', [App\Http\Controllers\BranchController::class, 'index']);
Route::view('todolist',"admin.todolist");
Route::view('allusers',"admin.allemployee");
Route::view('validation',"admin.validation");
Route::post('/checkvalidation', [App\Http\Controllers\BranchController::class, 'checkvalidation']);
Route::any('/identityjoin', [App\Http\Controllers\IdentitycardController::class, 'index']);
Route::view('attendance',"attendance");
Route::post('/attendance', [App\Http\Controllers\AttendanceController::class, 'create']);
Route::get('/ORM', function (){
    // $users = employee::where('id',4)->get();
//     $users = employee::insert([
//        'firstname'=>'Vipul',
//        'lastname'=>'Bhatt',
//        'email'=>'vip@gmail.com',
//        'mobile'=>'7012345678',
//        'branch_id'=>'89',
//        'salary'=>'32000',
//    ]);
    // $users = employee::where('id',8)->update(['firstname'=>'abc']);
     $users = employee::where('id',8)->delete();
   dd($users);
});