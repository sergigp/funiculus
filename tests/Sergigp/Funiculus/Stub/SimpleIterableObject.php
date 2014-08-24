<?php

namespace Sergigp\Funiculus\Tests\Stub;

class SimpleIterableObject implements \Iterator
{
    private $position = 0;
    private $array = [];

    public function __construct(array $myArray)
    {
        $this->array = $myArray;
    }

    function rewind()
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->array[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->array[$this->position]);
    }
}
