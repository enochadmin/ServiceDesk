<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\FileUploadController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// route to register users
Route::post('register',[AuthController::class , 'register']);
// route for login
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes in belows middleware are protected only for authenticated users
Route::middleware(['auth:sanctum'])->group(function(){
    // route for the logout
    Route::post('logout',[AuthController::class,'logout']);
    // route for updatepassword
    Route::post('updatePassword',[AuthController::class,'updatePassword']);
    // route for delete my account - sucided
    Route::DELETE('deleteMyAccount',[AuthController::class,'deleteMyAccount']);


});


Route::get('/project',[ProjectController::class,'index']);
Route::post('/project',[ProjectController::class,'store']);
Route::get('/project/{id}',[ProjectController::class,'show']);
Route::put('/project/{id}',[ProjectController::class,'update']);
Route::delete('/project/{id}',[ProjectController::class,'destroy']);
Route::get('/searchProject/{name}',[ProjectController::class,'searchProject']);

Route::get('/ticket',[TicketController::class,'index']);
Route::post('/ticket',[TicketController::class,'store']);
Route::get('/ticket/{id}',[TicketController::class,'show']);
Route::put('/ticket/{id}',[TicketController::class,'update']);
Route::delete('/ticket/{id}',[TicketController::class,'destroy']);
Route::get('/searchTicket/{name}',[TicketController::class,'searchProject']);


//Route::post('uploading-file-api', [FileUploadController::class, 'upload']);



//Route::resource('clients', ClientController::class);

 Route::get('/clients',[ClientController::class, 'index']);
 Route::post('/clients',[ClientController::class, 'store']);
 Route::put('/clients/{id}',[ClientController::class,'update']);
 Route::get('/clients/{id}',[ClientController::class, 'show']);
 Route::delete('/clients/{id}',[ClientController::class,'destroy']);
 Route::get('/clients/search/{ClientName}',[ClientController::class,'searchClient']);

//

 Route::get('/clientuser',[ClientUserController::class, 'index']);
 Route::post('/clientuser',[ClientUserController::class, 'store']);
 Route::put('/clientuser/{id}',[ClientUserController::class,'update']);
 Route::get('/clientuser/{id}',[ClientUserController::class, 'show']);
 Route::delete('/clientuser/{id}',[ClientUserController::class,'destroy']);
 Route::get('/clientuser/search/{ClientName}',[ClientUserController::class,'searchClient']);


//Route::get('/file-upload', [ FileUploadController::class, 'fileUpload' ])->name('file.upload');
Route::post('/upload', [ FileUploadController::class, 'fileUploadPost' ]);



