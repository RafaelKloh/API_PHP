<?php

use App\http\Route;


//Rotas de usuario
Route::get('/', 'home_controller@index');
Route::post('/users/create', 'user_controller@store');
Route::post('/users/login', 'user_controller@login');
Route::get('/users/fetch', 'user_controller@fetch');
Route::put('/users/update', 'user_controller@update');
Route::delete('/users/{id}/delete', 'user_controller@remove');


//Rotas de produtos
Route::post('/products/create', 'products_controller@store'); //ta funcionando 
Route::post('/products/fetch', 'products_controller@fetch'); //to fazendo
Route::put('/products/update', 'products_controller@update');
Route::delete('/products/{id}/delete', 'products_controller@remove');


