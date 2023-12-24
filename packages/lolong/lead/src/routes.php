<?php

use Illuminate\Http\Request;

Route::prefix('api')->group(function () {

    Route::group(['middleware' => ['api']], function () {
   //          Route::apiResources(['contacts1' =>'API\ContactsController']);
   //          Route::put('leads1/activities/{contact}', 'API\LeadsController@storeactivity');
			// Route::get('leads1/activities/{contact}', 'API\LeadsController@activities');
			// Route::put('leads1/tasks/{lead}', 'API\LeadsController@storetask');
			// Route::get('leads1/tasks/{lead}', 'API\LeadsController@tasks');
    });

});
