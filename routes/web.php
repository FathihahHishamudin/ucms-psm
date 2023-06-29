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

/* Route::get('/trymail', 'App\Http\Controllers\MailController@try'); */
Route::post('/conf/{conf}/addcochair', 'App\Http\Controllers\MailController@coChairInvitation')->middleware('auth');
Route::get('/tryview', 'App\Http\Controllers\MailController@tryview');

Route::get('/', 'App\Http\Controllers\ConferenceController@list');


Route::get('/create-conf', function () {return view('chair.createconfform');});
Route::post('/create-conf', 'App\Http\Controllers\ConferenceController@create')->middleware('auth');

Route::get('/conf/{conf}', 'App\Http\Controllers\ConferenceController@show')->middleware('auth');

Route::get('/conf/{conf}/register', 'App\Http\Controllers\ConferenceController@register')->middleware('auth');
Route::post('/conf/{conf}/register/addParticipant', 'App\Http\Controllers\ConferenceController@regParticipant')->middleware('auth');

Route::get('/conf/{conf}/contactus', 'App\Http\Controllers\ConferenceController@contact')->middleware('auth');
Route::get('/conf/{conf}/payment', 'App\Http\Controllers\PaymentController@index')->middleware('auth');
Route::post('/conf/{conf}/payment/upload', 'App\Http\Controllers\PaymentController@upload')->middleware('auth');
Route::post('/delete-pop', 'App\Http\Controllers\PaymentController@delete')->name('delete-pop');

Route::get('/conf/{conf}/committeemenu', 'App\Http\Controllers\ConferenceController@comenu')->middleware('auth');
Route::get('/conf/{conf}/committeemenu/updateconf', 'App\Http\Controllers\ConferenceController@edit')->middleware('auth');
Route::put('/conf/{conf}/committeemenu/updateconf', 'App\Http\Controllers\ConferenceController@update')->middleware('auth');

Route::get('/conf/{conf}/committeemenu/fees', 'App\Http\Controllers\FeesController@index')->middleware('auth');
Route::post('/conf/{conf}/committeemenu/add-fees', 'App\Http\Controllers\FeesController@store')->middleware('auth');

Route::get('conf/{conf}/committeemenu/participants', 'App\Http\Controllers\NormalParticipantController@participantlist')->middleware('auth');
Route::get('/conf/{conf}/committeemenu/cochair', 'App\Http\Controllers\PCCoChairController@index')->middleware('auth');

Route::get('/conf/{conf}/mypaper', 'App\Http\Controllers\ConferenceController@papermenu')->middleware('auth');
Route::put('/conf/{conf}/mypaper/upd-paper-details/', 'App\Http\Controllers\PaperController@updatePaperDet')->middleware('auth');
Route::post('/conf/{conf}/mypaper/upload', 'App\Http\Controllers\PaperController@upload')->middleware('auth');
Route::post('/delete', 'App\Http\Controllers\PaperController@delete')->name('delete');

Route::get('/conf/{conf}/reviewermenu', 'App\Http\Controllers\ConferenceController@reviewermenu')->middleware('auth');
Route::get('/conf/{conf}/reviewermenu/{review}', 'App\Http\Controllers\ReviewsController@review')->middleware('auth');
Route::put('/reviews/{rId}', 'App\Http\Controllers\ReviewsController@update')->name('review.update');

Route::get('/reviewacceptance/{conf}/{uId}', 'App\Http\Controllers\ReviewsController@showAcceptPage')->middleware('auth');
Route::post('/reviewer/update-status', 'App\Http\Controllers\ReviewsController@updateStatus')->name('reviewer.updateStatus')->middleware('auth');

Route::get('/cochairrole/{conf}/{uId}', 'App\Http\Controllers\PCCoChairController@showPage')->middleware('auth');
Route::post('/cochairrole/accept', 'App\Http\Controllers\PCCoChairController@accept')->name('cochair.accept')->middleware('auth');
Route::post('/cochairrole/decline', 'App\Http\Controllers\PCCoChairController@decline')->name('cochair.decline')->middleware('auth');
Route::delete('/{conf}/delete-cochair/{coId}', 'App\Http\Controllers\PCCoChairController@deletecochair')->middleware('auth');
Route::delete('/{conf}/delete-pending-cochair/{pcoId}', 'App\Http\Controllers\PCCoChairController@deletepending')->middleware('auth');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index'
    )->name('dashboard');
});
