<?php

require_once __DIR__ . '/autoload.php';

$articles = \App\Models\News::findAll();
include __DIR__ . '/App/Views/News/Default.html';

