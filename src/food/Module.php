<?php


namespace App\Alpa\Food;

use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function init()
    {
        parent::init();
        
        /*$this->params=[
            
        ];*/
        /*if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\food\commands';
        }*/
    }

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'App\Alpa\Food\commands';
        }
    }
}