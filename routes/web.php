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
Route::get('/search');
Route::get('/profile');
Route::get('/kitchen');