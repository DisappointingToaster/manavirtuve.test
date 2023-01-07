<?php

use App\Http\Controllers\main_route_handler;
use App\Http\Controllers\moderation_controller;
use App\Http\Controllers\recipe_controller;
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
Route::get('/profile/info',[main_route_handler::class,'profile']);
Route::get('/profile/security',[main_route_handler::class,'profileSecurity']);
Route::get('/kitchen',[recipe_controller::class,'kitchen']);
Route::get('/fridge',[recipe_controller::class,'fridge']);
Route::get('/recipes',[recipe_controller::class,'recipes']);
Route::get('/moderation',[main_route_handler::class,'moderation']);
Route::get('/recipes/{recipe}',[recipe_controller::class,'showSingleRecipe']);
Route::get('/kitchen/new',[recipe_controller::class,'addRecipe']);
Route::post('/recipes',[recipe_controller::class,'createRecipe']);
Route::get('/moderation/editFilters',[recipe_controller::class,'modifyFilters']);
Route::post('/moderation/newCategory',[recipe_controller::class,'createCategory']);
Route::post('/moderation/newIngredient',[recipe_controller::class,'createIngredient']);
Route::get('/recipes/{recipe}/edit',[recipe_controller::class,'editRecipe']);
Route::put('/recipes/{recipe}',[recipe_controller::class,'updateRecipe']);
Route::delete('/recipes/{recipe}',[recipe_controller::class,'deleteRecipe']);
Route::delete('/moderation/ingredient/{ingredient}',[recipe_controller::class,'deleteIngredient']);
Route::delete('/moderation/category/{category}',[recipe_controller::class,'deleteCategory']);
Route::post('/fridge',[recipe_controller::class,'fridgeIngredients']);
Route::put('/recipes/{recipe}/promote',[recipe_controller::class,'promoteRecipe']);