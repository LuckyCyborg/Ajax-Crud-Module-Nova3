<?php
Route::group(['prefix' => 'admin', 'namespace' => 'App\Modules\Crud\Controllers'], function(){
	
	Route::get('crud',               ['before' => 'auth', 'uses' => 'Crud@index']);
	Route::get('crud/load',          ['before' => 'auth', 'uses' => 'Crud@loadRecords']);
	
	Route::post('crud',              ['before' => 'auth', 'uses' => 'Crud@store']);
	Route::post('crud/{id}/edit',    ['before' => 'auth', 'uses' => 'Crud@edit']);
	Route::post('crud/{id}/update',  ['before' => 'auth', 'uses' => 'Crud@update']);
	Route::post('crud/{id}/destroy', ['before' => 'auth', 'uses' => 'Crud@destroy']);
});