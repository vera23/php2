<?php

namespace App\Models;


use App\Db;
use App\Model;
use App\MultiException;
use App\TArrayAccess;
use App\TIterator;

/**
 * @property \App\Models\Author $author
 * exists if the News object has not null author_id
 */
class News extends Model
{
    public $title;
    public $published;
    public $lead;
    public $text;
    public $author_id;

    const TABLE = "news";


    public static function findLastTreeNews()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . self::TABLE . ' ORDER BY published DESC LIMIT 3';
        return $db->findAll($sql, self::class);
    }

    /**
     * @return bool
     * the function checks the value of the forms field 'published', if it is empty it
     * sets the current time
     */
    public function beforeSave()
    {
        if (null == $this->published) {
            $this->published = date('Y-m-d H:i:s');
        }
        return true;
    }

    /**
     * functon is validating data that came from the form
     * @return bool
     */
    public function validate()
    {
        $e = new \App\Exceptions\MultiException();

        if (empty($this->title)) {
            $e[] = new \Exception('Напишите заголовок');
        }
        if (empty($this->lead)) {
            $e[] = new \Exception('Напишите введение');
        }
        if (empty($this->text)) {
            $e[] = new \Exception('Напишите текст новости');
        }
        if(!$e->isEmpty())
        {
            throw $e;
        }
        else return true;
    }


    /**
     * LAZY LOAD
     * @param $k
     * @return \App\Models\Author $author or null
     * and there is not empty author_id
     */
    public function __get($k)
    {
        switch ($k) {
            case 'author':
                return Author::findById($this->author_id);
                break;
            default:
                return null;
        }
    }

    /**
     * @param $k
     * @return bool
     * or false
     */
    public function __isset($k)
    {
        switch ($k) {
            case 'author':
                return !empty($this->author_id);
            default:
                return false;
        }
    }
}