<?php


namespace App\Alpa\Food\helpers\RoutesHelper;

use yii\helpers\Url;
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
        return Url::toRoute($this->get($extra_params));    
    }
    
    final public function __toString()
    {
        return $this->getRouteUrl();
    }
}