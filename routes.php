<?php

use bootstrap\Route;

Route::get('/','IndexController@index');

Route::get('/download/{id}','DownloadController@show');

Route::get('/read/{id}','ReadController@show');

Route::get('/video/{id}/{user}','VideoController@show');
