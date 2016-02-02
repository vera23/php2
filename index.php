<?php

require __DIR__ . '/autoload.php';

if(true==$_GET['delete']) {
    $article = new \App\Models\News();
    $article->id = (int) $_GET['id'];
    $article->delete();
}

$articles = \App\Models\News::findAll();
include __DIR__ . '/App/Views/News/Default.html';

