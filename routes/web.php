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

Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dash')->name('dashboard');

// Routes for adding new episodes
Route::get('/add', 'EpisodeController@add');
Route::post('/add', 'EpisodeController@store');

// Routes for editing existing episodes
Route::get('/episode/{id}/edit', 'EpisodeController@edit');
Route::post('/episode/{id}/update', 'EpisodeController@update');