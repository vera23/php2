<?php

require_once __DIR__ . '/autoload.php';

try {
    $app = new \App\Application();
    $app->run();
} catch (Exception $e) {
    if ($e instanceof PDOException) {

    }
}








