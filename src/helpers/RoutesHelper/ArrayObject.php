<?php


namespace App\Alpa\helpers\RoutesHelper;


class ArrayObject extends \ArrayObject
{
    public function __construct($array = array(), $flags = null, $iteratorClass = "ArrayIterator")
    {
        if (is_null($flags)) {
            $flags = static::ARRAY_AS_PROPS;
        }
        parent::__construct($array, $flags, $iteratorClass);
    }
}