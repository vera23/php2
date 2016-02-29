<?php

spl_autoload_register(function ($class) {
    $filename = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($filename)) {
        include $filename;
    }
});

define('DS', DIRECTORY_SEPARATOR);

require str_replace(['/', '\\'], DS, __DIR__ . '/vendor/autoload.php');

