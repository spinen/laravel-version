<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::get(Config::get('version.route.uri', 'version'), 'VersionController@version')
     ->name(Config::get('version.route.name', 'version'));
