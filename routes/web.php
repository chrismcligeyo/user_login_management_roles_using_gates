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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/admin/users', 'Admin\UserController', ['except' => ['show', 'create', 'store']]);

//manage user gate will be run any time any route in group is run, can be placed in individual routes
//with gate added in middleware using can, only author and admin can view user management, if subscriber, will be redirected to 403 page
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]); //was previousely above.namespace r


});
