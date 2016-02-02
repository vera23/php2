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

    public function checkForm() {
        !empty($post['title']) ? $this->title = $post['title'] : $this->title = 'Напишите заголовок!!';
        !empty($post['lead']) ? $this->lead = $post['lead'] : $this->lead = 'Напишите заголовок!!';
        !empty($post['text']) ? $this->text = $post['text'] : $this->text = 'Напишите текст новости!!';
    }
}