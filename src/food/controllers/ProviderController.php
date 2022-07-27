<?php

namespace App\Alpa\Food\controllers;

use App\Alpa\core\ControllerTrait;
use App\Alpa\Food\models\Provider;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\base\ErrorException;
use \App\Alpa\Food\helpers\RoutesHelper\RoutesCollection;

class ProviderController extends \yii\web\Controller
{
    use ControllerTrait;
    
    protected static array  $static_routes=[
        'index'=>['provider/'],
        'view'=>['provider/view'],
        'create'=>['provider/create'],
        'edit'=>['provider/edit'],
        'delete'=>['provider/delete']
    ];
    protected static function otherRoutes():array
    {
        return [
            MenuController::routes(),
            OrderController::routes()
        ];        
    }
    /**
     * {@inheritDoc}
     */
    
    public function beforeAction($action)
    {
        if (!(\Yii::$app->user->can('food_provider') || \Yii::$app->user->can('worker')) || !parent::beforeAction($action)) {
            throw new ForbiddenHttpException('Access is denied');
        }
        return true;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['worker'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','view','edit','delete'],
                        'roles' => ['food_provider'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $providers_list=Provider::getProviderList();
        $params=[
            'providers_list'=>$providers_list,
            'routes'=>$this->listRoutes(true)
        ];
        return $this->render('index',$params);
    }
    
    public function actionView($id)
    {
        $provider=Provider::getProvider($id);
        if($provider===null){
            throw new \yii\web\HttpException(404,'Page not found');
        }
        $routes=static::listRoutes(true);
        $routes->provider->setGlobalParams(['id'=>$id]);
        $routes->menu->setGlobalParams(['provider_id'=>$id]);
        $routes->order->setGlobalParams(['provider_id'=>$id]);
        $routes->provider->edit->replace(['id'=>$id,'redirect'=>Url::toRoute(['provider/view','id'=>$id])]);

        $params=[
            'provider'=>$provider,
            'routes'=>$routes,
        ];
        return $this->render('view',$params);
    }

    public function actionCreate()
    {
        $routes=static::listRoutes(false);
        if(\Yii::$app->request->isPost){
            $scope='Provider';//str_replace(__NAMESPACE__ . '\\', '', Provider::class);
            $provider_data=$this->request->post($scope);
            $provider=Provider::addProvider($provider_data['name'],$provider_data['is_enabled']);
            \Yii::$app->response->statusCode =201;
            return $this->redirect($routes->provider->edit(['id'=>$provider->id]));
        }
        
        return $this->render('edit-form',['provider'=>new Provider(),'routes'=>$routes, 'method'=>'POST']);
    }
    
    public function actionEdit(int $id)
    {       
        $redirect=$this->request->get('redirect');
        $routes=static::listRoutes(false);
        $get_params=[];
        if(\Yii::$app->request->isGet){
            $provider=Provider::getProvider($id);
            if($provider===null){
                throw new \yii\web\HttpException(404,'Page not found');
            }
        } else
        if(\Yii::$app->request->isPut && \Yii::$app->request->isPost){
            $scope='Provider';//str_replace(__NAMESPACE__ . '\\', '', Provider::class);
            $provider_data=$this->request->post($scope);
            $provider=Provider::updateProvider($id??$provider_data['id'],$provider_data['name'],$provider_data['is_enabled']);
            if($provider===null){
                throw new ErrorException('Failed to save');
            }
            if(!empty($redirect)){
                return $this->redirect(Url::to([$redirect]));
            }
        }
        $get_params['id']=$provider->id;
        if(!empty($redirect)){
            $get_params['redirect']=$redirect;
        }
        $routes->provider->edit->replace($get_params);
        return $this->render('edit-form',['routes'=>$routes,'provider'=>$provider,'method'=>'PUT']);
    }
    
    public function actionDelete(int $id)
    {
        $routes=static::routes();
        if(\Yii::$app->request->isDelete){
            if(!Provider::deleteProvider($id)){
                throw new ErrorException('Failed to delete');
            }
            \Yii::$app->response->statusCode =204;
            return $this->redirect(['/'.$routes->index]);
        }
    }
}