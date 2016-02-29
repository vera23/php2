<?php

namespace App\Controllers\News;


use App\Controller;
use App\Exceptions\E404Exception;
use \App\Models\News;

class Index extends Controller
{

    protected function actionIndex()
    {
        $articles = News::findAll();
        if(!$articles) {
            throw new E404Exception('В таблице ' . static::TABLE . 'нет записей');
        }
        $this->view->articles = $articles;
    }

    protected function actionOne()
    {
        $id = (int)$_GET['id'];
        $news = News::findById($id);
        if(!$news) {
            throw new E404Exception('В таблице нет записи, с id = ' . $id);
        }
        $this->view->article = $news;
    }

}