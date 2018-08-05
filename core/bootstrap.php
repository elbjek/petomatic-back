<?php
session_start();
use App\Core\App;
use App\Database\Connection;
use App\Database\QueryBuilder;

require 'core/functions.php';

App::put('config', $config = require "config.php" );

App::put('database', new QueryBuilder(
    Connection::make($config['database'])
));
