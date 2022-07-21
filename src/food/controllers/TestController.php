<?php


namespace App\Modules\Food\Controllers;

use Yii\Web\Controller;

class TestController extends Controller
{
    public function actionIndex(string $message='Успешно!')
    {
        return $this->render('index',['message'=>$message]);
    }
}