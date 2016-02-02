<?php

require __DIR__ . '/autoload.php';


$article = new \App\Models\News();
$article->id = (int)$_GET['id'];
$article->delete();

require __DIR__ . '/admin.php';
