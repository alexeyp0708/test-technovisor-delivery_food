<?php


namespace App\Alpa\core;



use App\Alpa\Food\helpers\RoutesHelper\ArrayObject;
use App\Alpa\Food\helpers\RoutesHelper\RoutesCollection;

abstract class Controller extends \yii\web\Controller
{
    /**
     * @var array Controller routes in static form
     */
    protected static array  $static_routes;
    
    /**
     * @var \App\Alpa\Food\helpers\RoutesHelper\RoutesCollection - Controller routes
     */
    protected  RoutesCollection  $routes;
    
    /**
     * @var \App\Alpa\Food\helpers\RoutesHelper\ArrayObject 
     */
    private  array $other_routes; 
    public static function routes():RoutesCollection
    {
        $buf=explode('\\',static::class);
        $name=$buf[count($buf)-1];
        $name=substr($name,0,-count('Controller'));
        return new RoutesCollection($name,static::$static_routes);
    }
    public function init()
    {
        $this->routes=static::routes();
        $buf_routes=static::otherRoutes();
        $other_routes=[];
        foreach($buf_routes as &$value){
            $other_routes[$value->getName()]=$value;
        }
        $this->other_routes=$other_routes;
        parent::init(); 
    }
    


    /**
     * @return RoutesCollection[]
     */
    abstract protected static function otherRoutes():array;
    public function getRoutes()
    {
        $routes=array_merge($this->other_routes,[$this->routes->getName()=>$this->routes]);
        return $routes;
    }
    
}