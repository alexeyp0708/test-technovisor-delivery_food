<?php


namespace App\Alpa\Food;

use yii\base\BootstrapInterface;
use yii\web\YiiAsset;

class Module extends \yii\base\Module implements BootstrapInterface
{
   /* public function init()
    {
        parent::init();

    }*/

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'App\Alpa\Food\commands';
        }
        $app->getUrlManager()->addRules([
                'GET food/provider'=>'food/provider',
                'GET food/provider/view/<id:\d+>'=>'food/provider/view',
                'GET,POST food/provider/create'=>'food/provider/create',
                'GET,PUT food/provider/edit/<id:\d+>'=>'food/provider/edit',
                'DELETE food/provider/delete/<id:\d+>' => 'food/provider/delete',            
        ], false);

    }
}