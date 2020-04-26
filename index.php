<?php

use Steampixel\Route;
use Controllers\LoadController;

define('CONFIG_DATABASE', include __DIR__ . '/config/database.php');
define('CONFIG_LOAD', include __DIR__ . '/config/load.php');

$classesDir = [
    'src/Steampixel/',
    'src/Services/Interfaces/',
    'src/Repository/Database/',
    'src/Controllers/',
    'src/Repository/',
    'src/Services/',
];
foreach ($classesDir as $classDir) {
    foreach (glob($classDir . '*.php') as $filename) {
        include $filename;
    }
}

require __DIR__ . '/vendor/autoload.php';

Route::add('/', function() {
    include(__DIR__ . '/template/general.php');
});

Route::add('/load', function() {
    $loadController = new LoadController();
    $result = $loadController->loadData();
    echo $result;
}, 'post');

Route::run('/');
