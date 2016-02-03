<?php

require __DIR__ . '/autoload.php';


if (!empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['lead'])) {
    $news = new \App\Models\News;
    $news->id = (int)$$_POST['id'];
    $news->title = $_POST['title'];
    $news->lead = $_POST['lead'];
    $news->text = $_POST['text'];
    $news->published = $_POST['published'];
    $res = $news->save();
    if(false == $res ){
        echo 'Ничего не сохранилось';
    }
    require __DIR__ . '/admin.php';
}

else {
    $article = new \App\Models\News();
    $article->checkForm();
    include __DIR__ . '/App/Views/News/Admin/Edit.html';
}


