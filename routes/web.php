<?php

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


//
Route::group(['middleware'=>'web'],function (){
    //главная страница
    Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);

    // страница с результатом поиска косметологов
    Route::match(['get','post'], '/cosmetologies',['uses'=>'CosmetologiesController@execute','as'=>'cosmetologies']);
    // страница конкретного косметолога
    Route::match(['get','post'], '/cosmetolog/{id}',['uses'=>'CosmetologController@execute','as'=>'cosmetolog']);

    // страница с результатом поиска статей
    Route::match(['get','post'],'/articles',['uses'=>'ArticlesController@execute','as'=>'articles']);
    Route::match(['get','post'],'/articlesSearch',['uses'=>'ArticlesController@articlesSearch','as'=>'articlesSearch']);
    //страница статьи
    Route::match(['get','post'], '/article/{id}',['uses'=>'ArticleController@execute','as'=>'article']);

    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout');


    //админ часть
    Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){

        //admin
        Route::get('/',['uses'=>'Admin\IndexController@index','as'=>'adminIndex']);


        Route::get('/personnel', ['uses'=>'Admin\PersonnelController@index','as'=>'admin.personnel.index']);

            Route::get('/personnel/create', ['uses'=>'Admin\PersonnelController@create','as'=>'admin.personnel.create']);
            Route::post('/personnel/store', ['uses'=>'Admin\PersonnelController@store','as'=>'admin.personnel.store']);

            Route::match(['get','post'], '/personnel/edit/{id}', ['uses'=>'Admin\PersonnelController@edit','as'=>'admin.personnel.edit']);
            Route::post('/personnel/update/{id}', ['uses'=>'Admin\PersonnelController@update','as'=>'admin.personnel.update']);

            Route::match(['get','post'], '/personnel/delete/{id}', ['uses'=>'Admin\PersonnelController@delete','as'=>'admin.personnel.delete']);



        Route::get('/services', ['uses'=>'Admin\ServicesController@index','as'=>'admin.services.index']);

            Route::get('/services/create', ['uses'=>'Admin\ServicesController@create','as'=>'admin.services.create']);
            Route::post('/services/store', ['uses'=>'Admin\ServicesController@store','as'=>'admin.services.store']);

            Route::match(['get','post'], '/services/edit/{id}', ['uses'=>'Admin\ServicesController@edit','as'=>'admin.services.edit']);
            Route::post('/services/update/{id}', ['uses'=>'Admin\ServicesController@update','as'=>'admin.services.update']);

            Route::match(['get','post'], '/services/delete/{id}', ['uses'=>'Admin\ServicesController@delete','as'=>'admin.services.delete']);



        Route::get('/cosmetologies', ['uses'=>'Admin\CosmetologiesController@index','as'=>'admin.cosmetologies.index']);

              Route::get('/cosmetologies/create', ['uses'=>'Admin\CosmetologiesController@create','as'=>'admin.cosmetologies.create']);
              Route::post('/cosmetologies/store', ['uses'=>'Admin\CosmetologiesController@store','as'=>'admin.cosmetologies.store']);

              Route::match(['get','post'], '/cosmetologies/edit/{id}', ['uses'=>'Admin\CosmetologiesController@edit','as'=>'admin.cosmetologies.edit']);
              Route::post('/cosmetologies/update/{id}', ['uses'=>'Admin\CosmetologiesController@update','as'=>'admin.cosmetologies.update']);

              Route::match(['get','post'], '/cosmetologies/delete/{id}', ['uses'=>'Admin\CosmetologiesController@delete','as'=>'admin.cosmetologies.delete']);



        Route::get('/promotion', ['uses'=>'Admin\PromotionController@index','as'=>'admin.promotions.index']);

                Route::get('/promotion/create', ['uses'=>'Admin\PromotionController@create','as'=>'admin.promotions.create']);
                Route::post('/promotion/store', ['uses'=>'Admin\PromotionController@store','as'=>'admin.promotions.store']);

                Route::match(['get','post'], '/promotion/edit/{id}', ['uses'=>'Admin\PromotionController@edit','as'=>'admin.promotions.edit']);
                Route::post('/promotion/update/{id}', ['uses'=>'Admin\PromotionController@update','as'=>'admin.promotions.update']);

                Route::match(['get','post'], '/promotion/delete/{id}', ['uses'=>'Admin\PromotionController@delete','as'=>'admin.promotions.delete']);

                Route::post('/promotion/changeCosmetologie', ['uses'=>'Admin\PromotionController@changeCosmetologie','as'=>'admin.promotions.changeCosmetologie']);


        Route::get('/articles', ['uses'=>'Admin\ArticlesController@index','as'=>'admin.articles.index']);

                Route::get('/articles/create', ['uses'=>'Admin\ArticlesController@create','as'=>'admin.articles.create']);
                Route::post('/articles/store', ['uses'=>'Admin\ArticlesController@store','as'=>'admin.articles.store']);

                Route::match(['get','post'], '/articles/edit/{id}', ['uses'=>'Admin\ArticlesController@edit','as'=>'admin.articles.edit']);
                Route::post('/articles/update/{id}', ['uses'=>'Admin\ArticlesController@update','as'=>'admin.articles.update']);

                Route::match(['get','post'], '/articles/delete/{id}', ['uses'=>'Admin\ArticlesController@delete','as'=>'admin.articles.delete']);



        Route::get('/permissions', ['uses'=>'Admin\PermissionsController@index','as'=>'admin.permissions.index']);
                Route::post('/permissions/store', ['uses'=>'Admin\PermissionsController@store','as'=>'admin.permissions.store']);


        Route::get('/users', ['uses'=>'Admin\UsersController@index','as'=>'admin.users.index']);

                Route::get('/users/create', ['uses'=>'Admin\UsersController@create','as'=>'admin.users.create']);
                Route::post('/users/store', ['uses'=>'Admin\UsersController@store','as'=>'admin.users.store']);

                Route::match(['get','post'], '/users/edit/{id}', ['uses'=>'Admin\UsersController@edit','as'=>'admin.users.edit']);
                Route::post('/users/update/{id}', ['uses'=>'Admin\UsersController@update','as'=>'admin.users.update']);

                Route::match(['get','post'], '/users/delete/{id}', ['uses'=>'Admin\UsersController@delete','as'=>'admin.users.delete']);


        Route::get('/reports', ['uses'=>'Admin\ReportsController@index','as'=>'admin.reports.index']);


    });

    //маршруты для авторизмции
    Auth::routes();

});





//Route::get('/home', 'HomeController@index')->name('home');
