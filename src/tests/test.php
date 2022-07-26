<?php

class RouteEntry
{
    private array $route;
    private string $name;
    public function __construct(string $name,array $route=[])
    {
        $this->init($name,$route);
    }

    private function init(string $name,array $route)
    {
        $this->setName($name);
        $this->set($route);
    }

    final public function set(array $route)
    {
        $this->route=$route;
    }

    final public function get(array $extra_params=[])
    {
        return array_replace($this->route,$extra_params);
    }

    final public function replace(array $extra_params=[])
    {
        $this->route=array_replace($this->route,$extra_params);
    }

    final public function copySelf(array $extra_params=[]):RouteEntry
    {
        return new static($this->name,$this->get($extra_params));
    }
    final public function setName(string $name):void
    {
        $this->name=$name;
    }
    final public function getName():string
    {
        return $this->name;
    }

    public function getRouteUrl(array $extra_params=[]):string
    {
        return implode('|',$this->get($extra_params));
    }

    final public function __toString()
    {
        return $this->getRouteUrl();
    }
}


class RouteEntriesCollection extends  \ArrayObject
{
    private array $global_params=[];
    public function __construct($array = array(), $flags = null, $iteratorClass = "ArrayIterator")
    {
        if(is_null($flags)){
            $flags=static::ARRAY_AS_PROPS;
        }
        if(!empty($array)){
            foreach($array as $key=>&$value){
                $value=static::initData($key,$value);
            }
        }
        unset($value);
        parent::__construct($array, $flags, $iteratorClass);
    }

    protected static function initData($key, $value):RouteEntry
    {
        if(is_array($value)){
            $value=new RouteEntry($key,$value);
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
    public function offsetGet($key):RouteEntry
    {
        $route=parent::offsetGet($key);
        if(!empty ($route)){
            $route=$route->copySelf($this->global_params);
        }
        return $route;
    }

    public function __call($name, $arguments)
    {
        return $this->offsetGet($name)->getRouteUrl(...$arguments);
    }
}

$collection= new RouteEntriesCollection(['test1'=>['test1_one','test1_two','test1_three','prop'=>'hello']]);
$collection->test2=['q','w','r'];
echo $collection->test2;

