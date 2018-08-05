<?php

require "vendor/autoload.php";
$query = require "core/bootstrap.php";

use \App\Core\Request;

\App\Core\Router::load("routes.php")->direct(Request::prepare(), Request::method());
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Origin: *');



