<?php

namespace App;

/**
 * Class Model
 * @package App
 */

/**
 * @var \PDO
 */


class Model
{
    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->findAll($sql, static::class);
    }

    public static function findById(int $id)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = ?';
        return $db->find($sql, static::class, [$id]);
    }

    /*public function findLast($n) {
        $db =
    }*/

    public function isNew()
    {
        return empty($this->id);
    }


    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' (' . (implode(',', $columns)) . ')' .
            ' VALUES (' . implode(',', array_keys($values)) . ' )';

        $db = Db::instance();
        $db->execute($sql, $values);

        $this->id = $db->lastInsertId();
    }

    public function update()
    {
        if ($this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k.'=:'.$k;
            $values[':' . $k] = $v;
        }

        $sql = 'UPDATE ' .static::TABLE . ' SET '. implode(',', $columns) . ' WHERE id=' .$this->id;

        $db = Db::instance();
        $db->execute($sql, $values);
    }

    public function beforeSave() {
        return true;
    }

    public function save() {
        $this->beforeSave();
        if($this->isNew()) {
            $this->insert();
        }
        else {
            $this->update();
        }
    }

    public function delete() {
        if($this->isNew()) {
            return;
        }
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=' . $this->id;
        $db = Db::instance();
        $db->execute($sql);
    }
}

