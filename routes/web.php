<?php

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



Auth::routes();

Route::get('/', function () {
    return view('home');
});

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'AdminUsersController@index')->name('home');


// admin Route group
Route::group(['middleware' => 'admin'], function (){

        //Route to view all users
        Route::get("admin/users/",'AdminUsersController@users')->name('admin.users')->middleware('admin');

        //resource that goes to the admin index via the controller
        Route::resource('/admin','AdminUsersController');

}
);




