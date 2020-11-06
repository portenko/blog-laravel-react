<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TagController;

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


Route::resource('article', ArticleController::class);
Route::resource('tag', TagController::class);

Route::middleware('auth:api')->group(function () {
//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });

});

Route::fallback(function(){
    return response()->json([
        'status' => 404,
        'message' => 'Data not found'
    ], 404);
});
