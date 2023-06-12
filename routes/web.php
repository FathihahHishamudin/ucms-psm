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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'App\Http\Controllers\ConferenceController@list');

Route::get('/create-conf', function () {return view('chair.createconfform');});
Route::post('/create-conf', 'App\Http\Controllers\ConferenceController@create')->middleware('auth');

Route::get('/conf/{conf}', 'App\Http\Controllers\ConferenceController@show')->middleware('auth');
Route::get('/conf/{conf}/contactus', 'App\Http\Controllers\ConferenceController@contact')->middleware('auth');
Route::get('/conf/{conf}/committeemenu', 'App\Http\Controllers\ConferenceController@comenu')->middleware('auth');

Route::get('/conf/{conf}/committeemenu/updateconf', 'App\Http\Controllers\ConferenceController@edit')->middleware('auth');
Route::put('/conf/{conf}/committeemenu/updateconf', 'App\Http\Controllers\ConferenceController@update')->middleware('auth');

Route::get('/conf/{conf}/committeemenu/fees', 'App\Http\Controllers\FeesController@index')->middleware('auth');
Route::post('/conf/{conf}/committeemenu/add-fees', 'App\Http\Controllers\FeesController@store')->middleware('auth');
Route::get('/conf/{conf}/committeemenu/edit-fees/{fee}', 'App\Http\Controllers\FeesController@edit')->middleware('auth');
Route::put('/conf/{conf}/committeemenu/edit-fees/{fee}', 'App\Http\Controllers\FeesController@update')->middleware('auth');
Route::delete('/delete-fee/{fee}', 'App\Http\Controllers\FeesController@delete')->middleware('auth');

Route::get('conf/{conf}/committeemenu/participants', 'App\Http\Controllers\NormalParticipantController@participantlist')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index'
    )->name('dashboard');
});
