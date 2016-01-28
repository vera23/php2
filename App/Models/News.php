<?php

namespace App\Models;


use App\Db;
use App\Model;

class News extends Model
{
    public $title;
    public $published;
    public $lead;
    public $text;

    const TABLE = "news";

    public static function findLastTreeNews() {
        $db = new Db();
        $sql = 'SELECT * FROM ' . self::TABLE . ' ORDER BY published DESC LIMIT 3';
        return $db->findAll($sql, self::class);
    }

}