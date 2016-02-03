<?php

require __DIR__ . '/autoload.php';

if (!empty($_POST['id'])) {
    $article = \App\Models\News::findById($_POST['id']);
} else {
    $article = new \App\Models\News();
}

$article->title = trim($_POST['title']);
$article->lead = trim($_POST['lead']);
$article->text = trim($_POST['text']);
$article->published = trim($_POST['published']);

if ($article->validate()) {
    $res = $article->save();
    if (false == $res) {
        echo 'Ничего не сохранилось';
    }
    require __DIR__ . '/admin.php';
} else {
    include __DIR__ . '/App/Views/News/Admin/Edit.html';
}


