<?php
Route::group(['prefix' => 'admin', 'namespace' => 'App\Modules\Crud\Controllers'], function(){
	
	Route::get('crud',               ['before' => 'auth', 'uses' => 'Crud@index']);
	Route::get('crud/load',          ['before' => 'auth', 'uses' => 'Crud@loadRecords']);
	
	Route::post('crud',              ['before' => 'auth|ajax', 'uses' => 'Ajax@store']);
	Route::post('crud/{id}/edit',    ['before' => 'auth|ajax', 'uses' => 'Ajax@edit']);
	Route::post('crud/{id}/update',  ['before' => 'auth|ajax', 'uses' => 'Ajax@update']);
	Route::post('crud/{id}/destroy', ['before' => 'auth|ajax', 'uses' => 'Ajax@destroy']);
});