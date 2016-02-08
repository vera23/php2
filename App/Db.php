<?php

namespace App;

class Db
{
    use TSingleton;

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

    public function execute($sql, array $values = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($values);
        return $res;
    }

    public function query($sql, $class, array $values = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($values);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    //� ���� query �� ���� ������������� ����� ���������� ������ �������� ��� ���� ������
    //��� ������� ������� ������ find � findAll

    public function find($sql, $class, array $values = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($values);
        if (false !== $res) {
            return $sth->fetchObject($class);
        }
        return false;
    }

    public function findAll($sql, $class, array $values = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($values);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
}