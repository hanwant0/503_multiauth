<?php

    /*
      |--------------------------------------------------------------------------
      | Web Routes
      |--------------------------------------------------------------------------
      |
      | This file is where you may define all of the routes that are handled
      | by your application. Just tell Laravel the URIs it should respond
      | to using a Closure or controller method. Build something great!
      |
     */
    Auth::routes();


    Route::group(['middleware' => ['ifadmin']], function ()
    {
        Route::get('admin/login', 'backend\Auth\LoginController@getLoginForm');
        Route::post('admin/login', 'backend\Auth\LoginController@login');

        Route::get('admin/register', 'backend\Auth\RegisterController@getRegisterForm');
        Route::post('admin/saveregister', 'backend\Auth\RegisterController@saveRegisterForm');

        Route::post('admin/password/email', 'backend\Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('admin/password/reset', 'backend\Auth\ResetPasswordController@reset');
        Route::get('admin/password/reset', 'backend\Auth\ForgotPasswordController@showLinkRequestForm');
        Route::get('admin/password/reset/{token}', 'backend\Auth\ResetPasswordController@showResetForm');
    });

    Route::group(['middleware' => ['admin']], function ()
    {
        Route::get('admin/dashboard', 'backend\AdminController@dashboard');
        Route::post('admin/logout', 'backend\Auth\LoginController@getLogout');

        Route::resource('admin/automanufacturer', 'backend\AutomanufacturerController');
        Route::get('automanufacturer-data', ['as' => 'AutomanufacturerControllerData', 'uses' => 'backend\AutomanufacturerController@anyData']);

        Route::resource('admin/auto', 'backend\AutoController');
        Route::get('auto-data', ['as' => 'AutoControllerData', 'uses' => 'backend\AutoController@anyData']);
    });


    Route::group(['middleware' => ['ifuser']], function ()
    {
        Route::get('user/login', 'frontend\Auth\LoginController@getLoginForm');
        Route::post('user/authenticate', 'frontend\Auth\LoginController@login');

        Route::get('user/register', 'frontend\Auth\RegisterController@getRegisterForm');
        Route::post('user/saveregister', 'frontend\Auth\RegisterController@saveRegisterForm');

        Route::post('user/password/email', 'frontend\Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('user/password/reset', 'frontend\Auth\ResetPasswordController@reset');
        Route::get('user/password/reset', 'frontend\Auth\ForgotPasswordController@showLinkRequestForm');
        Route::get('user/password/reset/{token}', 'frontend\Auth\ResetPasswordController@showResetForm');
    });

    Route::group(['middleware' => ['user']], function ()
    {

        Route::post('user/logout', 'frontend\Auth\LoginController@getLogout');
        Route::get('user/dashboard', 'frontend\UserController@dashboard');

        Route::get('user/dashboard1/', function ()
        {

            return view('frontend.dashboard');
        });
    });

    Route::group(['middleware' => ['guest']], function ()
    {

        Route::get('/', function ()
        {
            return view('welcome');
        });

        Route::get('/home', function ()
        {
            return view('frontend.home');
        });
    });







    