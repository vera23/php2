<?php

namespace App;


use App\Exceptions\E404Exception;

class Application
{
    public $parseUrl;
    public $action;
    public $params;
    public $class;
    public $controller;

    public $paramArray;
    public $request;
    public $folder;


    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        $this->parseUrl = parse_url($url);
        $this->getAction();
        $this->getParams();
        $this->getController();
    }

    protected function getController()
    {
        $this->controller = new $this->class;
        $this->controller->action($this->action);

        $this->controller->redirect();
    }

    protected function getAction()
    {
        $parseUrl['path'] = substr($this->parseUrl['path'], 1);
        $urlArray = explode('/', $parseUrl['path']);
        $this->getClass($urlArray);
        if (in_array('admin', $urlArray)) {
            $actionName = mb_convert_case($urlArray[2], MB_CASE_TITLE, "UTF-8");
        } else {
            $actionName = mb_convert_case($urlArray[1], MB_CASE_TITLE, "UTF-8");
        }
        return $this->action = $actionName ?: 'Index';
    }

    protected function getClass(array $urlArray)
    {
        if (in_array('admin', $urlArray)) {
            $className = 'Admin';
            $this->folder = mb_convert_case($urlArray[1], MB_CASE_TITLE, "UTF-8") ?: 'News';
        } else {
            $className = 'Index';
            $this->folder = mb_convert_case($urlArray[0], MB_CASE_TITLE, "UTF-8") ?: 'News';
        }

        $this->class = '\\App\\Controllers\\' . $this->folder . '\\' . $className;
    }

    protected function getParams()
    {
        parse_str($this->parseUrl['query'], $this->paramArray[]);
        return $_GET = $this->paramArray[0];
    }

}