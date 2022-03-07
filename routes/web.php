<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SessionController;
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
    return view('welcome');
});

Route::resource('/admin/courses',CourseController::class);
Route::resource('/admin/sessions',SessionController::class);

Route::get('admin/sessions/create/{id}',[SessionController::class,'create'])->name('sessions.create');



Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';