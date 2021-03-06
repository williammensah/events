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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
 Route::post('/2fa', function () {
     return redirect(URL()->previous());
 })->name('2fa')->middleware('2fa');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');
