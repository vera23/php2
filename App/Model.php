<?php

namespace App;

/**
 * Class Model
 * @package App
 */
use App\Exceptions\DbException;
use App\Exceptions\E404Exception;

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
        if (empty($db->findAll($sql, static::class))) {
            throw new E404Exception('В таблице ' . static::TABLE . 'нет записей');
        }
        return $db->findAll($sql, static::class);
    }

    public static function findById(int $id)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $values[':id'] = $id;
        if (!$db->find($sql, static::class, $values)) {
            throw new E404Exception('В таблице нет записи, с id = ' . $id);
        }
        return $db->find($sql, static::class, $values);
    }

    public function isNew()
    {
        return empty($this->id);
    }


    public function insert()
    {
        if (!$this->isNew()) {
            return false;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            //Сделаю Exception - удалю этот if
            if (preg_match('~Alert~', $k)) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' (' . (implode(',', $columns)) . ')' .
            ' VALUES (' . implode(',', array_keys($values)) . ' )';

        $db = Db::instance();
        $res = $db->execute($sql, $values);
        if (!$res) {
            throw new E404Exception('Запись в таблицу "' . static::TABLE . '" добавлена не была');
        }
        $this->id = $db->lastInsertId();
        return $res;
    }

    public function update()
    {
        if ($this->isNew()) {
            return false;
        }
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            //Сделаю Exception - удалю этот if
            if (preg_match('~Alert~', $k)) {
                continue;
            }
            $columns[] = $k . '=:' . $k;
            $values[':' . $k] = $v;
        }

        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(',', $columns) . ' WHERE id=:id';
        $values[':id'] = $this->id;
        $db = Db::instance();
        $res = $db->execute($sql, $values);
        if (!$res) {
            throw new E404Exception('Запись в талблице "' . static::TABLE . '" обновлена не была');
        }
        return $res;
    }


    public function validate()
    {
        return true;
    }

    public function fill(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    public function beforeSave()
    {
        return true;
    }

    public function save()
    {
        $this->beforeSave();
        $this->validate();
        return $this->isNew() ? $this->insert() : $this->update();
    }

    public function delete()
    {
        if ($this->isNew()) {
            return false;
        }
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $values[':id'] = $this->id;
        $db = Db::instance();
        $res = $db->execute($sql, $values);
        if (!$res) {
            throw new E404Exception('Запись в талблицы ' . static::TABLE . '" удалена не была');
        }
        return $res;
    }
}

