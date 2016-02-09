<?php

namespace App\Models;


use App\Db;
use App\Model;
use App\TArrayAccess;
use App\TIterator;

class News extends Model implements \ArrayAccess, \Iterator
{
    use TArrayAccess;
    use TIterator;

    /**
     * model News property
     * @var $author object contains object of Author class if
     * the object has not null author_id
     */

    public $title;
    public $published;
    public $lead;
    public $text;
    public $author_id;

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
     * functon is validating what came from the form
     * @return bool
     */
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

    protected $data = [];

    public function __set($k, $v)
    {
        return $this->data[$k] = $v;
    }

    /**
     * @param $k
     * @return mixed returns array or an object of the Author class if there were ->author required
     *and there is not empty author_id
     */
    public function __get($k)
    {
        if ('author' == $k && !empty($this->author_id)) {
            return $this->author = Author::findById($this->author_id);
        } else {
            return $this->data[$k];
        }
    }

    /**
     * @param $k
     * @return bool true if the $k == 'author' or the value is isset
     * or false
     */
    public function __isset($k)
    {
        if ('author' == $k && isset($data[$k])) {
            return true;
        }
        return false;
    }
}