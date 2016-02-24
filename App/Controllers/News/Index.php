<?php

namespace App\Controllers\News;


use App\Controller;

class Index extends Controller
{

    protected function actionIndex()
    {
        $this->view->articles = \App\Models\News::findAll();
    }

    protected function actionOne()
    {
        $id = (int)$_GET['id'];
        $this->view->article = \App\Models\News::findById($id);
    }

}