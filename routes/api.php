<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//to force users to login you mus use "auth:api" middleware
Route::resource('menus', 'MenuController');