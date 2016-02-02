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
    $news->save();
    require __DIR__ . '/index.php';
}

else {
    $article = new \App\Models\News();
    !empty($post['title']) ? $article->title = $post['title'] : $article->title = 'Напишите заголовок!!';
    !empty($post['lead']) ? $article->lead = $post['lead'] : $article->lead = 'Напишите заголовок!!';
    !empty($post['text']) ? $article->text = $post['text'] : $article->text = 'Напишите текст новости!!';
    include __DIR__ . '/App/Views/News/Edit.html';
}


