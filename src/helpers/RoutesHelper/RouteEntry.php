<?php


namespace App\Alpa\helpers\RoutesHelper;

use yii\helpers\Url;
class RouteEntry
{
    private array $route;
    private $scheme;
    private string $name;

    /**
     * RouteEntry constructor.
     * @param string $name
     * @param array|string $route
     * @param false $scheme
     */
    public function __construct(string $name, $route=[],$scheme = false)
    {        
        $this->init($name,$route,$scheme);
    }

    /**
     * @param string $name
     * @param array|string $route
     * @param false $scheme
     */
    private function init(string $name,$route,$scheme = false)
    {
        $this->scheme=$scheme;
        $this->setName($name);
        $this->set($route);
    }

    /**
     * @param array|string $route
     */
    final public function set($route)
    {
        if(is_string($route)){
            $route=[$route];
        }
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
        return new static($this->name,$this->get($extra_params),$this->scheme);           
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
        return Url::toRoute($this->get($extra_params),$this->scheme);    
    }
    
    final public function __toString()
    {
        return $this->getRouteUrl();
    }
}