<?php

namespace App\Controllers\Admin;


use App\Controller;
use App\Models\Author;

class News extends Controller
{
    protected function actionIndex()
    {
        $this->view->articles = \App\Models\News::findAll();
        $this->view->display(__DIR__ . '/../../templates/News/Admin/default.php');
    }

    protected function actionEdit()
    {
        if (null != $_GET['id']) {
            $id = (int)$_GET['id'];
            $this->view->article = \App\Models\News::findById($id);
            $this->view->authors = Author::findAll();
        }
        $this->view->display(__DIR__ . '/../../templates/News/Admin/edit.php');
    }

    public function actionSave()
    {
        if (!empty($_POST['id']) or $_POST['id'] == 'new') {
            $article = \App\Models\News::findById($_POST['id']);
        } else {
            $article = new \App\Models\News();
        }

        $article->title = trim($_POST['title']);
        $article->lead = trim($_POST['lead']);
        $article->text = trim($_POST['text']);
        $article->published = trim($_POST['published']);
        $article->author_id = trim($_POST['author']);
        if ($article->validate()) {
            $res = $article->save();
            if (false == $res) {
                exit('не выходит');
            }
            header('Location: /admin/news');
        } else {
            $this->view->display(__DIR__ . '/../../templates/News/Admin/edit.php');
        }
    }
}