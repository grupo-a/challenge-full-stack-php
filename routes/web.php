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
    return view('pages.login');
});
Route::post('/login', array('uses' => 'LoginController@login'));
Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
    Route::get('/', function () {
        return view('pages.students.index');
    })->name('list');
});
