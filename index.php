<?php

require_once __DIR__ . '/autoload.php';

try {
    $app = new \App\Application();
    $app->run();
} catch (Exception $e) {
    if ($e instanceof PDOException) {
        include __DIR__ . '\App\templates\error.php';
    }
    if($e instanceof \App\Exceptions\E404Exception) {
        include __DIR__ . '\App\templates\e404.php';
    }
    throw $e;
}








