<?php

namespace App;


trait TIterator
{
    private $position = 0;

    private $array = [];

    public function current()
    {
        return $this->array[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        return ++$this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->array[$this->position]);
    }
}