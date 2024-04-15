<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

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
Route::group(["middleware"=>"auth:api"],function(){
    Route::get('articles',[ArticleController::class,'index']); // Get All Articles
    Route::get('articles/{article}',[ArticleController::class,'show']);
    Route::post('articles',[ArticleController::class,'store']);
    Route::put('articles/{article}',[ArticleController::class,'update']);
    Route::delete('articles/{article}',[ArticleController::class,'delete']);

    Route::post('logout', [LoginController::class, 'logout']); // Moved inside authenticated group
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});

Route::post('register',[RegisterController::class,'register']);
Route::post('login', [LoginController::class, 'login']);
//Route::get('logout', [LoginController::class, 'logout']);

// Route::middleware('auth:api')
//     ->get('/user', function (Request $request) {
//         return $request->user();
//     });

// Route::get('articles', function(){
//     // If the Content-Type and Accepts headers sre set to 'application/json' ,
//     // this will  return a JSON response/structure. This will cleaned up later.

//     return Article::all();

// });

// Route::get('articles/{id}', function($id){
//     return Article::find($id);
// });

// Route::post('articles',function(Request $request){
//     return Article::create($request->all());
// });

// Route::put('articles/{id}', function(Request $request, $id){
//     $article = Article::findOrFail($id);
//     $article->update($request->all());

//     return $article;
// });

// Route::delete('articles/{id}', function($id){
//     Article::find($id)->delete();

//     return 204;
// });
