<?php

namespace App;


class Route
{
    public $parseUrl;
    public $action;
    public $params;
    public $class;

    public $paramArray;
    public $request;
    public $folder;

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $this->parseUrl = parse_url($url);
        $this->getAction();
        $this->getParams();
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

        if (!in_array('admin', $urlArray)) {
            $this->class = mb_convert_case($urlArray[0], MB_CASE_TITLE, "UTF-8");
            $this->folder = 'index';
        }
        else {
            $this->class = mb_convert_case($urlArray[1], MB_CASE_TITLE, "UTF-8");
            $this->folder = 'admin';
        }
    }

    protected function getParams()
    {
        parse_str($this->parseUrl['query'], $this->paramArray[]);
        return $_GET = $this->paramArray[0];
    }

}