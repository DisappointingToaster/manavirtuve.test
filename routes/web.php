<?php

use App\Http\Controllers\main_route_handler;
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
Route::get('/kitchen',[main_route_handler::class,'kitchen']);
Route::get('/fridge',[main_route_handler::class,'fridge']);
Route::get('/recipes',[recipe_controller::class,'recipes']);
Route::get('/moderation',[main_route_handler::class,'moderation']);
Route::get('/recipes/{recipe}',[recipe_controller::class,'showSingleRecipe']);
Route::get('/kitchen/new',[main_route_handler::class,'addRecipe']);
Route::post('/recipes',[recipe_controller::class,'createRecipe']);