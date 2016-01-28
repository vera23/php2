<?php

namespace App;


class Model
{
    const TABLE = '';

    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = ?';
        return $db->find($sql, static::class, [$id]);
    }
}

