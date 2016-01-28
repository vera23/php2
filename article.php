<?php

require __DIR__ . '/autoload.php';


$id  = $_GET['id'];
$article = \App\Models\News::findById($id);
include __DIR__ . '/App/Views/News/Article.html';