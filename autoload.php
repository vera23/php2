<?php

define('DS', DIRECTORY_SEPARATOR);

require str_replace(['/', '\\'], DS, __DIR__ . '/vendor/autoload.php');

function __autoload($class)
{
    require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
}