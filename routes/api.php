<?php

Route::apiResource('todos', 'Api\TodoController', ['except' => ['update','show']]);
Route::post('todos/{todo}/complete', 'Api\TodoCompleteController@store');