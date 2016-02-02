<?php

namespace App;

class Db
{
    use Singleton;

    protected $dbh;

    protected function getConfig()
    {
        return $config = Config::instance()->data;
    }

    protected function __construct()
    {
        $config = $this->getConfig();
        $this->dbh = new \PDO('mysql:host=' .
            $config['db']['host'] . ';dbname=' . $config['db']['dbname'],
            $config['db']['user'], $config['db']['password']);
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
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
        return false;
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