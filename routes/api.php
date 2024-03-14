<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'logout']);
Route::middleware('auth:sanctum','admin')->group(function(){
    //information of all users
    Route::get('/users',[UserController::class,'index']);
    //information of one user
    Route::get('/user/{id}',[UserController::class,'show']);
    //delete one user
    Route::delete('/users/{id}',[UserController::class,'destroy']);
}
);
//update your information
Route::post('/users/{id}',[UserController::class,'update']);
// Route::middleware('auth:sanctum')->get('/cars',[CarController::class,'index']);
Route::post('/colors',[ColorController::class,'store']);
Route::get('/colors',[ColorController::class,'index']);
Route::delete('/colors/{id}',[ColorController::class,'destroy']);
Route::post('/colors/{id}',[ColorController::class,'update']);
?>