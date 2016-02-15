<?php

namespace App;

class Config
{
    use TSingleton;

    public $data = [];

    protected function __construct()
    {
        $this->data = require __DIR__ . '/config_data.php';
    }
}