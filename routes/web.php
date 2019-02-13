<?php

Auth::routes();

Route::get('/', 'HomeController@mainpage')->name('mainpage');


Route::prefix('/backoffice')->middleware(['role:Manager|Cashier|Waiter'])->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('/roles', 'Admin\RoleController');
	Route::post('/addPermissionsToRole', 'Admin\RoleController@addPermissionsToRole')->name('addPermissionsToRole');
	Route::resource('/menutypes', 'Admin\MenuTypeController', ['except' => ['show', 'create', 'edit']]);
	Route::post('updatenamesajax/{id}', 'Admin\MenuTypeController@updatenamesajax')->name('updatenamesajax');
	Route::resource('/menus', 'Admin\MenuController');
	Route::post('updateitemnames/{id}', 'Admin\MenuController@updateitemnames')->name('updateitemnames');
	Route::post('updatepricesajax/{id}', 'Admin\MenuController@updatepricesajax')->name('updatepricesajax');
	Route::resource('/orders', 'Admin\OrderController', ['except' => ['destroy', 'update', 'edit']]);
	Route::post('updateorderstatus/{id}', 'Admin\OrderController@updateorderstatus')->name('updateorderstatus');
	Route::resource('/employees', 'Admin\UserController', ['except' => ['show', 'create', 'edit', 'store', 'update', 'destroy']]);


	Route::get('getItems/{id}', 'Admin\OrderController@getItems');
});
