<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Auth\AccountsController;
use App\Http\Controllers\Auth\AuthUsersController;
use App\Http\Controllers\Admin\CourseAccessController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserTrackingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Artisan;

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


Route::get('/search', [SearchController::class, 'index'])->name('search');


Route::get('optimize', function () {
    Artisan::call('optimize');
    dd('optimized');
});
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard.index');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.index');
    })->middleware(['auth'])->name('dashboard');

    // -----------------------------------------------------Courses--------------------------------------------------------
    Route::resource('/admin/courses',CourseController::class);
    Route::get('admin/active/courses',[CourseController::class,'active'])->name('courses.active');
    Route::get('admin/disabled/courses',[CourseController::class,'disabled'])->name('courses.disabled');
    Route::get('/admin/filtering/courses', [CourseController::class, 'filtering']);
    Route::get('/admin/filtering/{status}/courses', [CourseController::class, 'filteringCourses']);
    Route::get('admin/courses/changeStatus/{id}',[CourseController::class,'changeStatus'])->name('courses.changeStatus');
    // -----------------------------------------------------Sessions--------------------------------------------------------
    Route::resource('/admin/sessions',SessionController::class)->except('create');
    Route::get('admin/sessions/create/{id}',[SessionController::class,'create'])->name('sessions.create');
    Route::get('admin/sessions/changeStatus/{id}',[SessionController::class,'changeStatus'])->name('sessions.changeStatus');
    // -----------------------------------------------------Accounts--------------------------------------------------------
    Route::resource('/admin/accounts',AuthUsersController::class)->except('index');
    Route::get('admin/softdeleted/accounts',[AccountsController::class,'accountsDeleted'])->name('accounts.deleted');
    Route::get('admin/softdeleted/accounts/{id}',[AccountsController::class, 'restoreAccounts'])->name('accounts.restore');
    Route::resource('/admin/req',AccountsController::class);
    Route::get('admin/accounts/{id}/approve',[AuthUsersController::class,'approve'])->name('accounts.approve');
    Route::get('admin/accounts/{id}/resetDevice',[AuthUsersController::class,'resetDevice'])->name('accounts.resetDevice');
    Route::get('admin/accounts/{value?}',[AuthUsersController::class,'index'])->name('accounts.index');
    Route::get('admin/active/accounts/{value?}',[AuthUsersController::class,'active'])->name('accounts.active');
    Route::get('admin/accounts/{id}/ban',[AuthUsersController::class,'ban'])->name('accounts.ban');
    Route::get('admin/accounts/{id}/enrolled',[CourseController::class, 'enrollment'])->name('accounts.enrolled');
    Route::get('admin/accounts/{id}/enrolled/courses',[CourseController::class, 'enrollmentCourses'])->name('courses.enrolled');
    Route::post('admin/accounts/action',[CourseController::class, 'action'])->name('accounts.action');
    Route::get('admin/accounts/{id}/enroll',[CourseController::class, 'enroll'])->name('accounts.enroll');
    Route::get('admin/accounts/{id}/disable',[CourseController::class, 'disable'])->name('accounts.disable');
    // -----------------------------------------------------Course Requests-------------------------------------------------
    Route::get('/admin/request/courseaccess/{id?}',[CourseAccessController::class, 'index'])->name('courseaccess.requests');
    Route::post('admin/request/courseaccess/{id}/approved',[CourseAccessController::class,'approve'])->name('courseaccess.approve');
    Route::get('admin/request/courseaccess/{id}/disable',[CourseAccessController::class,'disable'])->name('courseaccess.disable');
    Route::post('admin/request/courseaccess/action/requests',[CourseAccessController::class,'action'])->name('courseaccess.action');
    Route::get('admin/request/courseaccess/disabled/requests',[CourseAccessController::class,'indexDeleted'])->name('requests.disabled');
    Route::delete('admin/request/courseaccess/{id}',[CourseAccessController::class,'destroy'])->name('courseaccess.destroy');
    //-------------------------------------------------------- ADD TO USER TRACKING -----------------------------------------------
    Route::get('admin/request/courseaccess/{user_id}/{course_id}/counter',[UserTrackingController::class,'showcounter'])->name('usertracking.counter');
    Route::resource('/admin/subjects',SubjectController::class);
    Route::resource('/admin/faculty',FacultyController::class);
    Route::get('admin/student/forgetpass',[RegisteredUserController::class,'showForgetPass'])->name('forget.pass');
    Route::get('export/enrolledUsers',[CourseAccessController::class,'export'])->name('export.enrolled');
});

if(App::environment('production')){
    Route::get('storage/{file}', function($file){
        $filepath = storage_path('app/public/'.$file);
        if(!is_file($filepath)){
            abort(404);
        }
        return response()->file($filepath);
    })->where('file', '.+');
    }

    Route::get('optimize', function () {
        Artisan::call('optimize');
        dd('optimized');
    });
    Route::get('migrate', function () {
        Artisan::call('migrate');
        dd('migrated');
    });


require __DIR__.'/auth.php';
