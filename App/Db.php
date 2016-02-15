<?php

namespace App;

use App\Exceptions\DbException;

class Db
{
    use TSingleton;

    protected $dbh;

    protected function getConfig()
    {
        $config = Config::instance()->data;
        return $config;
    }

    protected function __construct()
    {
        $config = $this->getConfig();

        if(empty($config['db']) || !is_array($config))
        {
            throw new \PDOException('Нет данных для соединения с базой');
        }

        $this->dbh = new \PDO('mysql:host=' .
            $config['db']['host'] . ';dbname=' . $config['db']['dbname'],
            $config['db']['user'], $config['db']['password']);

        if (!$this->dbh) {
            throw new \PDOException('Не удается соединиться с базой данных!');
        }
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