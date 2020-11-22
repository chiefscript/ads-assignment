<?php

use App\Http\Controllers\ProjectController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', 'App\Http\Controllers\ProjectController@index');
    Route::get('projects', 'App\Http\Controllers\ProjectController@index');
    Route::get('projects/show/{id}', 'App\Http\Controllers\ProjectController@show');
    Route::post('projects', 'App\Http\Controllers\ProjectController@store');
    Route::post('projects/edit', 'App\Http\Controllers\ProjectController@update');
    Route::post('projects/delete/{id}', 'App\Http\Controllers\ProjectController@destroy');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/', 'App\Http\Controllers\ProjectAPIController@index');
    Route::get('projects/all', 'App\Http\Controllers\ProjectAPIController@index');
    Route::get('projects/country/{country}', 'App\Http\Controllers\ProjectAPIController@countryProjects');
    Route::get('projects/status/{status}', 'App\Http\Controllers\ProjectAPIController@projectStatus');
});
