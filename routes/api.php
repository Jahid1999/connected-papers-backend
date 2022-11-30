<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//users
Route::post('users/login', [\App\Http\Controllers\Api\UserController::class, 'authorizeUserLogin']);
Route::get('users/{user_id}',[\App\Http\Controllers\Api\UserController::class, 'getUserbyId']);
Route::put('users/password', [\App\Http\Controllers\Api\UserController::class, 'changePassowrd']);
Route::put('users', [\App\Http\Controllers\Api\UserController::class, 'updateUser']);
Route::post('users', [\App\Http\Controllers\Api\UserController::class, 'createUser']);

//papers
Route::post('papers', [\App\Http\Controllers\Api\PaperController::class, 'storePapers']);
Route::post('users/{user_id}/papers/{paper_id}/favorite/add', [\App\Http\Controllers\Api\FavoriteController::class, 'addToFavorite']);
Route::delete('papers/{paper_id}/favorite/{favorite_id}', [\App\Http\Controllers\Api\FavoriteController::class, 'removeFromFavorite']);

//favorite
Route::get('users/{user_id}/favorites',[\App\Http\Controllers\Api\FavoriteController::class, 'getFavouriteByUserId']);

//folder
Route::get('folders/{folder_id}', [\App\Http\Controllers\Api\FolderController::class, 'getEverythingOfFolder']);
Route::post('folders', [\App\Http\Controllers\Api\FolderController::class, 'createFolder']);
Route::get('extract', [\App\Http\Controllers\Api\FolderController::class, 'parseFile']);

//notes
Route::get('papers/{paper_id}/notes', [\App\Http\Controllers\Api\NoteController::class, 'getNotesOfSinglePaper']);
Route::put('notes', [\App\Http\Controllers\Api\NoteController::class, 'updateNote']);
Route::post('notes', [\App\Http\Controllers\Api\NoteController::class, 'createNote']);
Route::delete('delete/notes/{note_id}', [\App\Http\Controllers\Api\NoteController::class, 'deleteNote']);


