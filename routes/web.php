<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function () {
    ///guest
    Route::group(['middleware' => 'guest'], function () {
        //
        Route::get('login', [UserController::class, 'index'])->name('student.login');
        Route::get('register', [UserController::class, 'register'])->name('student.register');

        Route::post('authenticate', [UserController::class, 'authenticate'])->name('student.authenticate');
    });



    //auth
    Route::group(['middleware' => 'auth'], function () {
        //
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('student.dashboard');
        Route::get('logout', [UserController::class, 'logout'])->name('student.logout');
        Route::get('changePassword', [UserController::class, 'changePassword'])->name('student.changePassword');
        Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('student.updatePassword');
    });
});
//for middleware the code is added inside bootstrap/cache/app
//for middleware initialization code is added in app/Http/Middleware
//GO THrough these middleware.
Route::group(['prefix' => 'staff'], function () {
    Route::group(['middleware' => 'teacher.guest'], function () {
        Route::get('login', [TeacherController::class, 'login'])->name('teacher.login');
        Route::post('authenticate', [TeacherController::class, 'authenticate'])->name('teacher.authenticate');
    });

    Route::group(['middleware' => 'teacher.auth'], function () {
        Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        Route::get('register', [TeacherController::class, 'register'])->name('teacher.register');
        Route::get('changePassword', [TeacherController::class, 'changePassword'])->name('teacher.changePassword');
        Route::post('updatePassword', [TeacherController::class, 'updatePassword'])->name('teacher.updatePassword');
        Route::get('logout', [TeacherController::class, 'logout'])->name('teacher.logout');
    });
});

Route::group(['prefix' => 'superadmin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::get('register', [AdminController::class, 'register'])->name('admin.register');
        Route::post('login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'], function () {

        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('changePassword', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        Route::post('updatePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
        Route::get('form', [AdminController::class, 'form'])->name('admin.form');

        Route::get('table', [AdminController::class, 'table'])->name('admin.table');






        //Announcements Route
        Route::get('announcement/create', [AnnouncementController::class, 'index'])->name('announcement.create');
        Route::post('announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');
        Route::get('announcement/read', [AnnouncementController::class, 'read'])->name('announcement.read');
        Route::get('announcement/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcement.edit');
        Route::put('announcement/update/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
        Route::delete('announcement/delete/{id}', [AnnouncementController::class, 'delete'])->name('announcement.delete');




        //Teacher Route
        Route::get('staff/create', [TeacherController::class, 'index'])->name('teacher.create');
        Route::post('staff/store', [TeacherController::class, 'store'])->name('teacher.store');
        Route::get('staff/read', [TeacherController::class, 'read'])->name('teacher.read');
        Route::get('staff/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
        Route::put('staff/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('staff/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');







        Route::get('admin/create', [StudentController::class, 'index'])->name('student.create');
        Route::post('admin/store', [StudentController::class, 'store'])->name('student.store');
        Route::get('admin/read', [StudentController::class, 'read'])->name('student.read');
        Route::get('admin/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
        Route::put('admin/update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('admin/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
    });
});
