<?php


namespace App\Alpa\Food\controllers;


use App\Alpa\Core\Controller;
use App\Alpa\core\ControllerTrait;

class OrderController extends \yii\web\Controller
{
    use ControllerTrait;
    protected static array  $static_routes=[
        'index'=>['order']
    ];
    protected static function otherRoutes():array
    {
        return [

        ];
    }
}