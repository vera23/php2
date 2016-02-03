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

    public $titleAlert;
    public $leadAlert;
    public $textAlert;

    const TABLE = "news";


    public static function findLastTreeNews()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . self::TABLE . ' ORDER BY published DESC LIMIT 3';
        return $db->findAll($sql, self::class);
    }

    public function beforeSave()
    {
        if (null == $this->published) {
            $this->published = date('Y-m-d H:i:s');
        }
        return true;
    }

    public function validate()
    {
        if (empty($this->title)) {
            $this->titleAlert = 'Напишите заголовок';
        }
        if (empty($this->lead)) {
            $this->leadAlert = 'Напишите введение';
        }
        if (empty($this->text)) {
            $this->textAlert = 'Напишите текст новости';
        }
        if (!empty($this->titleAlert) || !empty($this->leadAlert) || !empty($this->textAlert)) {
            return false;
        } else
            return true;
    }
}