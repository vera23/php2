<?php

namespace App;

class Db
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('mysql:host=127.0.0.1;dbname=php2', 'root', '');
    }

    public function execute($sql, array $binded = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($binded);
        return $res;
    }

    public function query($sql, $class, array $binded = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($binded);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    //В один query не могу предусмотреть нужно возвращать массив объектов или один объект
    //Как вариант сделала методы find и findAll

    public function find($sql, $class, array $binded = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($binded);
        if (false !== $res) {
            return $sth->fetchObject($class);
        }
        return [];
    }

    public function findAll($sql, $class, array $binded = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($binded);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
}