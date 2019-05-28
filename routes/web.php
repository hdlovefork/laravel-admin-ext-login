<?php

use Dean\Login\Http\Controllers\LoginController;

Route::get('/auth/login', LoginController::class.'@getLogin');
Route::post('auth/login', LoginController::class.'@postLogin');