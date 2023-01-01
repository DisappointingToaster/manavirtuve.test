<?php

use App\Http\Controllers\main_route_handler;
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
Route::get('/profile',[main_route_handler::class,'profile']);
Route::get('/kitchen',[main_route_handler::class,'kitchen']);
Route::get('/fridge',[main_route_handler::class,'fridge']);
Route::get('/recipes',[main_route_handler::class,'recipes']);