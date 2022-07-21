<?php

namespace App\Alpa\Food\controllers;

use yii\web\Controller;
class TestController extends Controller
{
    public function actionIndex(string $message='Success')
    {
        //return $this->render('index');
        return $this->render('index',['message'=>$message]);
    }
}