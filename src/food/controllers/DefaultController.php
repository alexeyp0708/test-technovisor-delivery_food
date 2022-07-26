<?php

namespace App\Alpa\Food\controllers;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class DefaultController extends Controller
{
    public function beforeAction($action)
    {
        if (!\Yii::$app->user->can('worker') || !parent::beforeAction($action)) {
            throw new ForbiddenHttpException('Access is denied');
        }
        return true;
    }
    public function actionIndex(string $message='Success')
    {
        //return $this->render('index');
        return $this->render('index',['message'=>$message]);
    }
}