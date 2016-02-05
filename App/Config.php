<?php

namespace App;

class Config
{
    use Singleton;

    public $data = [];

    protected function __construct() {
        $this->data = require __DIR__ . '/config_data.php';
    }
}