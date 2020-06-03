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
    return view('welcome');
});

//Route::get('/home', 'HomeController@index')->name('home');

//Author route
Route::resource('/author','AuthorController');

//Subscriber route
Route::resource('/subscriber','SubscriberController');
//Route::get('subscriber/home','SubscriberController@');

// admin Route group
Route::group(['middleware' => 'admin'], function (){

        Route::get('/home', 'UsersController@index')->name('home');

        //Route to view all users
        Route::get("admin/users/",'UsersController@users')->name('admin.users')->middleware('admin');

        //resource that goes to the admin index via the controller
        Route::resource('/admin','UsersController');

}
);






