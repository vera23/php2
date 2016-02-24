<?php

require_once __DIR__ . '/autoload.php';

use \App\Logger;

$view = new \App\View();

try {
    $app = new \App\Application();
    $app->run();
} catch (Exception $e) {

    Logger::write($e);

    if ($e instanceof PDOException) {
        $view->e = $e;
        $view->display(__DIR__ . '\App\templates\error.php');
    }
    if ($e instanceof \App\Exceptions\E404Exception) {
        $view->e = $e;
        $view->display(__DIR__ . '\App\templates\e404.php');
    }
}








