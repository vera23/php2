<?php

require __DIR__ . '/autoload.php';


if(null != $_GET['id']) {
    $id = (int)$_GET['id'];
    $article = \App\Models\News::findById($id);
}
include __DIR__ . '/App/Views/News/Edit.html';