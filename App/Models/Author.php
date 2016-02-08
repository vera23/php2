<?php

namespace App\Models;


use App\Model;

class Author extends Model
{

    /**
     * @var string $name contains the author's of the article name
     */
    public $name;

    const TABLE = 'authors';
}