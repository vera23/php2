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

    public function checkForm()
    {
        !empty($_POST['title']) ? $this->title = $_POST['title'] : $this->title = 'Напишите заголовок!!';
        !empty($_POST['lead']) ? $this->lead = $_POST['lead'] : $this->lead = 'Напишите заголовок!!';
        !empty($_POST['text']) ? $this->text = $_POST['text'] : $this->text = 'Напишите текст новости!!';
    }
}