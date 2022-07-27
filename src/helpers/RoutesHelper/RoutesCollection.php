<?php


namespace App\Alpa\helpers\RoutesHelper;

final class RoutesCollection extends  ArrayObject
{
    private array $global_params=[];
    private string $name;
    public function __construct(string $name,$array = array(), $flags = null, $iteratorClass = "ArrayIterator")
    {
        $this->name=$name;
        if(!empty($array)){
            foreach($array as $key=>&$value){
                $value=static::initData($key,$value);
            }
        }
        unset($value);
        parent::__construct($array, $flags, $iteratorClass);
    }
    public function getName()
    {
        return $this->name;
    }
    private static function initData($key, $value):RouteEntry
    {
        if(is_array($value)){
            $value=new RouteEntry($key,...$value);
        } 
        if(!($value instanceof RouteEntry)){
            throw new \TypeError('Wrong value type');
        }
        $value->setName($key);
        return $value;
    }

    /**
     * @param int|string $key
     * @param array|RouteEntry $value
     */
    public function offsetSet($key, $value)
    {
        $value=static::initData($key,$value);
        parent::offsetSet($key, $value);
    }
    
    public function setGlobalParams(array $params)
    {
        $this->global_params=$params;
    }
    
   /* public function offsetGet($key):RouteEntry
    {
        $route=parent::offsetGet($key);
        if(!empty ($route)){
            $route=$route->copySelf($this->global_params);
        }
        return $route;
    }*/

    public function __call($name, $arguments)
    {
        return $this->offsetGet($name)->getRouteUrl(...$arguments);
    }
}