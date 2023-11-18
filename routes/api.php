<?php

use App\Http\Controllers\API\postscontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Authcontroller;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);

});
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/posts',[postscontroller::class,'index'])->middleware('auth:api');
    Route::get('/posts/{id}',[postscontroller::class,'show']);
    Route::post('/posts/create',[postscontroller::class,'create']);
    Route::post('/posts/update/{id}',[postscontroller::class,'update']);
    Route::delete('/posts/distroy/{id}',[postscontroller::class,'distroy']);

});
Route::get('/posts',[postscontroller::class,'index'])->middleware('jwt.verify');
Route::get('/posts/{id}',[postscontroller::class,'show']);
Route::post('/posts/create',[postscontroller::class,'create']);
Route::post('/posts/update/{id}',[postscontroller::class,'update']);
Route::delete('/posts/distroy/{id}',[postscontroller::class,'distroy']);
