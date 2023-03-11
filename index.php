<?php
require_once "vendor/autoload.php";
require "route.php";
Route::uri('/', "DatabaseFetch@index");