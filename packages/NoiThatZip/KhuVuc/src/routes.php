<?php
Route::group(['namespace' => '\NoiThatZip\KhuVuc\Controllers'], function() {

        Route::get('khu-vuc', 'Categories@index');

})