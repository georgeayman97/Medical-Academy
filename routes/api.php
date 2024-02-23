<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\CoursesAccessController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\Api\SessionsAccessController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/tokens', [AccessTokensController::class, 'store']);
Route::post('auth/courses', [CoursesAccessController::class, 'index'])
    ->middleware('auth:sanctum');
Route::post('auth/courses/show', [CoursesAccessController::class, 'show'])
    ->middleware('auth:sanctum');
Route::get('auth/user/courses', [FacultyController::class, 'userCourses'])
    ->middleware('auth:sanctum');
Route::get('auth/user/profile', [AccessTokensController::class, 'show'])
    ->middleware('auth:sanctum');
// -----------------------------------------------FOR COURSE REQUESTS---------------------------------------------------    
Route::get('faculties', [FacultyController::class, 'index']);
Route::post('auth/course/request', [CoursesAccessController::class, 'store'])
    ->middleware('auth:sanctum');

Route::post('auth/sessions', [SessionsAccessController::class, 'show'])
    ->middleware('auth:sanctum');
Route::get('auth/sessions',function(){ return response()->json(123);});

Route::post('auth/register', [RegisteredUserController::class, 'store']);
Route::post('auth/forgetPassword', [RegisteredUserController::class, 'forget_password']);
Route::post('auth/courseSearch', [RegisteredUserController::class, 'course_search'])->middleware('auth:sanctum');
Route::delete('auth/tokens', [AccessTokensController::class, 'destroy'])
    ->middleware('auth:sanctum');
// --------------------------------------------------------AFTER LOGIN--------------------------------------------------- 
Route::get('faculty/years', [FacultyController::class, 'facultyYears'])
    ->middleware('auth:sanctum');
Route::post('faculty/year/subjects', [FacultyController::class, 'facultySubjects'])
    ->middleware('auth:sanctum');