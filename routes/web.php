<?php

use Illuminate\Support\Facades\Route;


    Route::get('/clear', function () {
        $clearcache = Artisan::call('cache:clear');
        echo "Cache cleared<br>";

        $clearview = Artisan::call('view:clear');
        echo "View cleared<br>";

        $clearconfig = Artisan::call('config:cache');
        echo "Config cleared<br>";
    });


    Route::get('locale/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    })->name('locale');

    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('login', 'Auth\LoginController@login')->name('login.submit');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('dashboard','DashboardController@index')->name('home');

        Route::resource('student','Modules\StudentController');
        Route::resource('user','Modules\UserController');
        Route::resource('books','Modules\BookController');
        Route::resource('class','Modules\ClassController');
        Route::resource('subject','Modules\SubjectController');
        Route::resource('transport','Modules\TransportController');
        Route::resource('attendance','Modules\AttendanceController');
        Route::resource('roles','Modules\RolesController');
        Route::resource('notice','Modules\NoticeController');
        Route::resource('message','Modules\MessageController');

        Route::get('fee','Modules\FeeController@index')->name('fee');
        Route::get('fee/collection','Modules\FeeController@collect')->name('fee.collect');
        Route::post('fee/collection','Modules\FeeController@collectSubmit')->name('fee.collect.submit');

        Route::get('expenses','Modules\ExpensesController@index')->name('expenses');
        Route::get('expenses/new','Modules\ExpensesController@new')->name('expenses.collect');
        Route::post('expenses/new','Modules\ExpensesController@newSubmit')->name('expenses.collect.submit');


    });

