<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteCharityController;
use App\Http\Controllers\CharityCategoryController;
use App\Http\Controllers\CategoryController;
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

//fixed all routing to be Similar with favorite-charities

// Routes for Users
Route::get('/allUsers', [UserController::class, 'allUsers']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/createUser', [UserController::class, 'createUser']);
Route::post('/userLogin', [UserController::class, 'userLogin']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
// Routes for Charity
Route::get('/allCharity', [CharityController::class, 'allCharity']);
Route::get('/charity/{id}', [CharityController::class, 'show']);
Route::post('/createCharity', [CharityController::class, 'createCharity']);
Route::put('updateCharity/{id}', [CharityController::class, 'updateCharity']);
Route::delete('deleteCharity/{id}', [CharityController::class, 'deleteCharity']);

// Routes for Campaigns
Route::get('/allCampaigns', [CampaignController::class, 'allCampaigns']);
Route::get('/campaigns/{id}', [CampaignController::class, 'show']);
Route::post('/createCampaign', [CampaignController::class, 'createCampaign']);
Route::put('updateCampaign/{id}', [CampaignController::class, 'updateCampaign']);
Route::delete('deleteCampaign/{id}', [CampaignController::class, 'deleteCampaign']);

// Routes for Comments
Route::get('/allComments', [CommentController::class, 'allComments']);
Route::get('/comment/{id}', [CommentController::class, 'show']);
Route::post('/createComment', [CommentController::class, 'createComment']);
Route::put('updateComment/{id}', [CommentController::class, 'updateComment']);
Route::delete('deleteComment/{id}', [CommentController::class, 'deleteComment']);

// Category routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// CharityCategory routes
Route::get('/charity-categories', [CharityCategoryController::class, 'index']);
Route::get('/charity-categories/{id}', [CharityCategoryController::class, 'show']);
Route::post('/charity-categories', [CharityCategoryController::class, 'store']);
Route::put('/charity-categories/{id}', [CharityCategoryController::class, 'update']);
Route::delete('/charity-categories/{id}', [CharityCategoryController::class, 'destroy']);

// FavoriteCharity routes
// Route::group(['prefix' => 'FavoriteCharity', 'as' => 'FavoriteCharity.'], function () {
//     Route::get('/', [FavoriteCharityController::class, 'index'])->name('showallFavoriteCharity');
//     Route::get('/{id}', [FavoriteCharityController::class, 'show'])->name('show');
//     Route::post('/', [FavoriteCharityController::class, 'store'])->name('store');
//     Route::put('/{id}', [FavoriteCharityController::class, 'update'])->name('update');
//     Route::delete('/{id}', [FavoriteCharityController::class, 'destroy'])->name('delete') ;
// });
