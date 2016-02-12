<?php

require_once __DIR__ . '/autoload.php';


$route = new \App\Route();

if($route->folder == 'admin') {
    $controller = new \App\Controllers\Admin\News();
    $controller->action($route->action);

}

else {
    $controller = new \App\Controllers\Index\News();
    $controller->action($route->action);
}

