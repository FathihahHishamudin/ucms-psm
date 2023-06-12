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
Route::post('/create-conf', 'App\Http\Controllers\ConferenceController@create');

Route::get('/conf/{conf}', 'App\Http\Controllers\ConferenceController@show');
Route::get('/conf/{conf}/contactus', 'App\Http\Controllers\ConferenceController@contact');
Route::get('/conf/{conf}/committeemenu', 'App\Http\Controllers\ConferenceController@comenu');

Route::get('/conf/{conf}/committeemenu/updateconf', 'App\Http\Controllers\ConferenceController@edit');
Route::put('/conf/{conf}/committeemenu/updateconf', 'App\Http\Controllers\ConferenceController@update');

Route::get('/conf/{conf}/committeemenu/fees', 'App\Http\Controllers\FeesController@index');
Route::post('/conf/{conf}/committeemenu/add-fees', 'App\Http\Controllers\FeesController@store');
Route::get('/conf/{conf}/committeemenu/edit-fees/{fee}', 'App\Http\Controllers\FeesController@edit');
Route::put('/conf/{conf}/committeemenu/edit-fees/{fee}', 'App\Http\Controllers\FeesController@update');
Route::delete('/delete-fee/{fee}', 'App\Http\Controllers\FeesController@delete')->middleware('auth');

Route::get('conf/{conf}/committeemenu/participants', 'App\Http\Controllers\NormalParticipantController@participantlist');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index'
    )->name('dashboard');
});
