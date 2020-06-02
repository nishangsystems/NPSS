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


    Route::post('login', 'Auth\LoginController@login')->name('login.submit');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('dashboard','DashboardController@index')->name('home');
        Route::get('','DashboardController@index');

        Route::resource('student','Modules\StudentController');
        Route::resource('user','Modules\UserController');
        Route::resource('books','Modules\BookController');

        Route::resource('class','Modules\ClassController')->except(['create']);
        Route::get('class/teacher/{class_id}','Modules\ClassController@teacher')->name('class.teacher');
        Route::post('class/teacher/{class_id}','Modules\ClassController@Addteacher')->name('class.teacher.add');

        Route::resource('subject','Modules\SubjectController');
        Route::resource('transport','Modules\TransportController');
        Route::resource('attendance','Modules\AttendanceController');
        Route::resource('roles','Modules\RolesController');
        Route::get('permissions', 'Modules\RolesController@permissions')->name('roles.permissions');
        Route::get('assign_role', 'Modules\RolesController@rolesView')->name('roles.assign');
        Route::post('assign_role', 'Modules\RolesController@rolesStore')->name('roles.assign.post');
        Route::resource('notice','Modules\NoticeController');
        Route::resource('message','Modules\MessageController');

        Route::get('fee','Modules\FeeController@index')->name('fee');
        Route::get('fee/collection','Modules\FeeController@collect')->name('fee.collect');
        Route::get('class/fee/status','Modules\FeeController@classFee')->name('class.fee');
        Route::post('class/fee/status','Modules\FeeController@classFeeUpdate')->name('class.fee.update');
        Route::post('fee/collection','Modules\FeeController@store')->name('fee.collect.submit');
        Route::get('fee/type','Modules\FeeController@type')->name('fee.type');
        Route::post('fee/type','Modules\FeeController@typePost')->name('fee.type.post');
        Route::get('fee/owing','Modules\FeeController@owing')->name('fee.owing');

        Route::get('expenses','Modules\ExpensesController@index')->name('expenses');
        Route::get('expenses/new','Modules\ExpensesController@new')->name('expenses.collect');
        Route::post('expenses/new','Modules\ExpensesController@newSubmit')->name('expenses.collect.submit');

        Route::get('setting/session', 'Modules\SettingController@session')->name('settings.session');
        Route::post('setting/session', 'Modules\SettingController@sessionPost')->name('settings.sessionPost');
        Route::get('setting/terms', 'Modules\SettingController@terms')->name('settings.terms');
        Route::get('setting/sequences', 'Modules\SettingController@sequences')->name('settings.sequences');

        Route::post('config','Modules\SettingController@config')->name('config.set');
    });

Route::get('/image/{filename}', 'ImageController@renderImage')->name('image.render');
Route::get('/document/{filename}', 'DocumentController@renderDocument')->name('document.render');
