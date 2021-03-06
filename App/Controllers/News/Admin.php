<?php

namespace App\Controllers\News;


use App\Controller;
use App\Exceptions\E404Exception;
use App\Models\Author;
use App\Exceptions\MultiException;
use \App\Models\News;

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
            $this->view->article = News::findById($id);
            if(!$this->view->article) {
                throw new E404Exception('В таблице нет записи, с id = ' . $id);
            }
        } else {
            $this->view->article = $article = new News();
        }
        $this->view->authors = Author::findAll();
    }

    public function actionSave()
    {
        if (!empty($_POST['id']) or $_POST['id'] == 'new') {
            $article = News::findById($_POST['id']);
        } else {
            $article = new News();
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
        $article = News::findById($_GET['id']);
        $article->delete();
        if(!$article->delete) {
            throw new E404Exception('Запись в талблицы ' . static::TABLE . '" удалена не была');
        }
        header('Location: /admin/news');
    }
}