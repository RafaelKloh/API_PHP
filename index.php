<?php
require_once __DIR__ ."/vendor/autoload.php";
require_once __DIR__ ."/src/routes/main.php";

use App\core\core;
use App\http\route;

core::dispatch(route::Routes());

