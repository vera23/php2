<?php

require_once __DIR__ . '/autoload.php';

/*$view = new \App\View();
$view->title = 'Why not?';
$view->users = \App\Models\User::findAll();
$view->display(__DIR__ . '/App/templates/index.php');*/



$articles = \App\Models\News::findAll();
include __DIR__ . '/App/Views/News/Index/Default.html';
