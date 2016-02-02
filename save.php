<?php

require __DIR__ . '/autoload.php';

$post = $_POST;

if (!empty($post['title']) && !empty($post['text']) && !empty($post['lead'])) {
    $news = new \App\Models\News;
    $news->id = (int)$post['id'];
    $news->title = $post['title'];
    $news->lead = $post['lead'];
    $news->text = $post['text'];
    $news->published = $post['published'];
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


