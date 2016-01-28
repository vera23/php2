<?php

require __DIR__ . '/autoload.php';

$articles = \App\Models\News::findLastTreeNews();
include __DIR__ . '/App/Views/News/Default.html';



