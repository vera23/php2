<?php

namespace App\Exceptions;


use App\TCollection;


class MultiException extends \Exception
    implements \Iterator, \ArrayAccess, \Countable
{
    use TCollection;

}