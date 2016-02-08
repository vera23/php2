<?php

require_once __DIR__ . '/autoload.php';

/*$view = new \App\View();
$view->title = 'Why not?';
$view->users = \App\Models\User::findAll();
$view->display(__DIR__ . '/App/templates/index.php');
*/


$a = ['one' => 'ololo', 'two' => 'alala'];

$news = new \App\Models\News($a);
$news[] = 'tree';

var_dump($news);