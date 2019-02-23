<?php

use Illuminate\Support\Facades\Route;

Route::get('version', 'VersionController@version')
     ->name('version');
