<?php


namespace App\Alpa\core;



use App\Alpa\helpers\RoutesHelper\ArrayObject;
use App\Alpa\helpers\RoutesHelper\RoutesCollection;

trait  ControllerTrait
{
    /**
     * @var array $static_routes Controller routes
     * describe all routes in this property as if you were passing arguments to Url::toRoute()
     * @example
     * protected static array $static_routes=[
     *  'index'=>['controller',false],//Url::toRoute(['controller'],false)
     *  'view'=>[['controller/view','id'=>1]], //Url::toRoute(['controller/view','id'=1])
     * 'edit'=>[['controller/edit','id'=>1],false] //Url::toRoute(['controller/edit','id'=1],false)
     * ];
     */
   // protected static array  $static_routes=[];

    /**
     * Declaring other routes that will be used in the component
     * @return RoutesCollection[] Other routes that will be used in the component
     * @example 
     * protected static function otherRoutes() {
     *      return [
     *          // $routes = static::listRoutes(); 
     *          MenuController::routes(),// Access  $routes->menu;
     *          'arbitrary_name'=>OrderController::routes(),// Access  $routes->arbitrary_name;
     *      ];
     * }
     */
    protected static function otherRoutes():array
    {
        //return [];
        throw new \Exception('You need to implement the method'.get_class().'::otherRoutes');
    }
    protected static function structuredOtherRoutes():array
    {
        $other_routes=static::otherRoutes();
        $structured_array=[];
        foreach($other_routes as $key=>$value){
            if(is_numeric($key)){
                if($value instanceof RoutesCollection){
                    $key=$value->getName();
                }
            } 
            if($value instanceof RoutesCollection){
                $structured_array[$key]=$value;
            }
        }
        return $structured_array;
    }
    /**
     * @return \App\Alpa\helpers\RoutesHelper\RoutesCollection
     */
    public static function routes():RoutesCollection
    {
        $buf=explode('\\',static::class);
        $name=$buf[count($buf)-1];
        $name=strtolower(substr($name,0,-strlen('Controller')));
        return new RoutesCollection($name,static::$static_routes);
    }

    /**
     * Returns all declared routes, including the routes of the current controller
     * The peculiarity of this method is that it generates new objects.
     * @return \App\Alpa\helpers\RoutesHelper\ArrayObject
     *  @example
     * $routes=static::generateRoutes();
     * echo $routes->provider->index // (magic RouteEntry::__toString())returned result Url::toRoute(['provider/index']);
     * echo $routes->provider->index->getRouteUrl() // returned result Url::toRoute(['provider/index']);
     * echo $routes->provider->index(['id'=>1]) // (magic RoutesCollection::__call())  returned result Url::toRoute(['provider/index?id=1']);
     * echo $routes->provider->index->getRouteUrl(['id'=>1]) //   returned result Url::toRoute(['provider/index?id=1']);
     */
    public static function listRoutes($is_other=false):ArrayObject
    {
        if($is_other){
            $other_routes=static::structuredOtherRoutes();
        } else{
            $other_routes=[];
        }
        $routes=static::routes();
        $routes=array_merge($other_routes,[$routes->getName()=>$routes]);
        return new ArrayObject($routes);
    }
}