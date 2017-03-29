<?php

use bootstrap\Route;

Route::get('/','IndexController@index');

Route::get('/show/{id}','IndexController@show');

Route::get('/read/{id}','ReadController@show');

Route::get('/video/{id}/{user}','VideoController@show');
