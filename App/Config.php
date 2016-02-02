<?php

namespace App;

class Config
{
    use Singleton;

    public $data = [
        'db' => [
           'host' => '127.0.0.1',
            'dbname' => 'php2',
            'user' => 'root',
            'password' => '',
        ]
    ];

    protected function __construct() {

    }
}