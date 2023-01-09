<?php

use App\Http\Controllers\comment_controller;
use App\Http\Controllers\main_route_handler;
use App\Http\Controllers\moderation_controller;
use App\Http\Controllers\recipe_controller;
use App\Http\Controllers\user_controller;
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


Route::get('/', [main_route_handler::class,'index']);
Route::get('/search',[main_route_handler::class,'search']);
Route::get('/profile/info',[main_route_handler::class,'profile'])->middleware('auth');
Route::get('/profile/security',[main_route_handler::class,'profileSecurity'])->middleware('auth');
Route::get('/kitchen',[recipe_controller::class,'kitchen'])->middleware('auth');
Route::get('/recipes',[recipe_controller::class,'recipes']);
Route::get('/moderation',[moderation_controller::class,'moderation'])->middleware('auth','moderation');
Route::get('/recipes/{recipe}',[recipe_controller::class,'showSingleRecipe']);
Route::get('/kitchen/new',[recipe_controller::class,'addRecipe'])->middleware('auth');
Route::post('/recipes',[recipe_controller::class,'createRecipe'])->middleware('auth');
Route::get('/moderation/editFilters',[recipe_controller::class,'modifyFilters'])->middleware('auth','moderation');
Route::post('/moderation/newCategory',[recipe_controller::class,'createCategory'])->middleware('auth','moderation');
Route::post('/moderation/newIngredient',[recipe_controller::class,'createIngredient'])->middleware('auth','moderation');
Route::get('/recipes/{recipe}/edit',[recipe_controller::class,'editRecipe'])->middleware('auth');
Route::put('/recipes/{recipe}',[recipe_controller::class,'updateRecipe'])->middleware('auth');
Route::delete('/recipes/{recipe}',[recipe_controller::class,'deleteRecipe'])->middleware('auth');
Route::delete('/moderation/ingredient/{ingredient}',[recipe_controller::class,'deleteIngredient'])->middleware('auth','moderation');
Route::delete('/moderation/category/{category}',[recipe_controller::class,'deleteCategory'])->middleware('auth','moderation');
Route::put('/recipes/{recipe}/promote',[recipe_controller::class,'promoteRecipe'])->middleware('auth');
Route::get('/register',[user_controller::class,'register'])->middleware('guest');
Route::post('/users',[user_controller::class,'createUser']);
Route::post('/logout',[user_controller::class,'logoutUser'])->middleware('auth');
Route::get('/login',[user_controller::class,'login'])->name('login')->middleware('guest');;
Route::post('/login',[user_controller::class,'loginUser'])->middleware('guest');;
Route::get('/profile/update',[user_controller::class,'update']);
Route::put('/users/{user}/update',[user_controller::class,'updateUser']);
Route::put('/recipes/{recipe}/publish',[recipe_controller::class,'publishRecipe']);
Route::post('/recipes/{recipe}/comment',[comment_controller::class,'postComment']);
Route::get('/users/{user}',[moderation_controller::class,'getUserPage'])->middleware('auth','moderation');
Route::get('/report/{user}',[moderation_controller::class,'report']);
Route::post('/report',[moderation_controller::class,'reportUser']);
Route::put('/recipes/{recipe}/forceHide',[recipe_controller::class,'forceHide'])->middleware('auth','moderation');
Route::put('/users/{user}/prohibitComment',[moderation_controller::class,'prohibitComment'])->middleware('auth','moderation');
Route::put('/users/{user}/prohibitPost',[moderation_controller::class,'prohibitPost'])->middleware('auth','moderation');