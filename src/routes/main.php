<?php

use App\http\Route;

Route::get('/', 'home_controller@index');
Route::post('/users/create', 'user_controller@store');
Route::post('/users/login', 'user_controller@login');
Route::get('/users/fetch', 'user_controller@fetch');
Route::put('/users/update', 'user_controller@update');
Route::delete('/users/{id}/delete', 'user_controller@remove');

