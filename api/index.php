<?php

require_once __DIR__ . '/vendor/autoload.php';

use TheFarm\App\Application;

$app = new TheFarm\App\Application('prod');
$app['debug'] = true;
$app->run();