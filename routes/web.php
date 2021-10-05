<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\BillController;

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

Route::get('/home', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Google oauth authentication routes
Route::get('auth/redirect', 'App\Http\Controllers\Auth\SocialController@redirect');
Route::get('callback', 'App\Http\Controllers\Auth\SocialController@callback');

//Microsoft oauth authentication routes
Route::get('/o365callback', 'App\Http\Controllers\Auth\SocialController@handleMicrosoftProviderCallback');
Route::get('/microsoft_redirect', 'App\Http\Controllers\Auth\SocialController@redirectToMicrosoftProvider')->name('microsoft');



Route::get('file-upload', [ FileUploadController::class, 'fileUpload' ])->name('file.upload');
Route::post('/file-upload', [ FileUploadController::class, 'fileUploadPost' ])->name('file.upload.post');




Route::get('/not', [BillController::class, 'sendNotification']);
