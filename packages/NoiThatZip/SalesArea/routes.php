<?php
Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function(){
	Route::resource('salesareas', 	'\NoiThatZip\SalesArea\Http\Controllers\SalesAreasController');
});