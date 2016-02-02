<?php

require __DIR__ . '/autoload.php';

$post = $_POST;

$news = new \App\Models\News;
$news->id = (int)$post['id'];
$news->title = $post['title'];
$news->lead = $post['lead'];
$news->text = $post['text'];
$news->published = $post['published'];
$news->save();

