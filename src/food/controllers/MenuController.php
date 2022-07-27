<?php


namespace App\Alpa\Food\controllers;


use App\Alpa\Core\Controller;
use App\Alpa\core\ControllerTrait;

class MenuController extends \yii\web\Controller
{
    use ControllerTrait;
    protected static array  $static_routes=[
        'index'=>['menu']
    ];
    protected static function otherRoutes():array
    {
        return [
        ];
    }
}