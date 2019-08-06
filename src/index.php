<?php

const DS = DIRECTORY_SEPARATOR;
require(__DIR__ . DS . '..' . DS . 'vendor' . DS . 'autoload.php');

function error_handler(Exception $e)
{
    echo "Caught unhandled exception [{$e->getMessage}]";
    exit;
}
set_exception_handler('error_handler');

$app =& new App\Main;
$app->helloWorld();

$app->foreachInternalPointer();

