<?php

namespace App;


abstract class Controller
{
    protected $view;
    protected $action;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        $this->action = $action;
        $methodName = 'action' . $action;
        return $this->$methodName();
    }

    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function redirect()
    {
        $pathToTemplate = $this->getTemplatePath() . '/' . $this->action . '.php';
        if(file_exists($pathToTemplate)) {
            $this->view->display($pathToTemplate);
        }
    }

    protected function getTemplatePath()
    {
        $class = explode('\\', static::class);
        $array = [];
        foreach ($class as $value) {
            if ($value == 'Controllers') {
                $array[] = 'templates';
            } else {
                $array[] = $value;
            }
        }
        return implode('/', $array);
    }
}