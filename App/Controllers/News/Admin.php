<?php

namespace App\Controllers\News;


use App\Controller;
use App\Models\Author;
use App\Exceptions\MultiException;

class Admin extends Controller
{
    protected function actionIndex()
    {
        $this->view->articles = \App\Models\News::findAll();
    }

    protected function actionEdit()
    {
        if (null != $_GET['id'] && $_GET['id'] != 'new') {
            $id = (int)$_GET['id'];
            $this->view->article = \App\Models\News::findById($id);
        } else {
            $this->view->article = $article = new \App\Models\News();
        }
        $this->view->authors = Author::findAll();
    }

    public function actionSave()
    {
        if (!empty($_POST['id']) or $_POST['id'] == 'new') {
            $article = \App\Models\News::findById($_POST['id']);
        } else {
            $article = new \App\Models\News();
        }

        if ($this->isPost()) {
            try {
                $article->fill($_POST);
                if ($article->save()) {
                    header('Location: /admin/news');
                }
            } catch (MultiException $e) {
                $this->view->article = $article;
                $this->view->authors = Author::findAll();
                $this->view->errors = $e;
                $this->view->display(__DIR__ . '/../../templates/News/Admin/edit.php');
            }
        }
    }

    public function actionDelete()
    {
        $article = \App\Models\News::findById($_GET['id']);
        $article->delete();
        header('Location: /admin/news');
    }
}