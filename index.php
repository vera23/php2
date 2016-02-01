<?php

require __DIR__ . '/autoload.php';

$news = new \App\Models\News();

$news->title = "Title";
$news->lead = "Lead";
$news->text = "Tetx";
$news->published = "2016-02-01 17:54:00";
$news->insert();
include __DIR__ . '/App/Views/News/Default.html';



