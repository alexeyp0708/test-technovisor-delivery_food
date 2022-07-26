<?php

namespace App\Alpa\Food\controllers;

use App\Alpa\core\Controller;
use App\Alpa\Food\models\Provider;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use \App\Alpa\Food\helpers\RoutesHelper\RoutesCollection;

class ProviderController extends Controller
{
    
    protected static array  $staticRoutes=[
        'index'=>['food/provider'],
        'view'=>['food/provide/view'],
        'create'=>['food/provider/create'],
        'edit'=>['food/provider/edit'],
        'delete'=>['food/provider/delete']
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
        var_dump($this->getRoute());
        $providers_list=Provider::getProviderList();
        $params=[
            'providers_list'=>$providers_list,
            'routes'=>$this->getRoutes()
        ];
        return $this->render('index',$params);
    }
    
    public function actionView($id)
    {
        $provider=Provider::getProvider($id);
        $redirect=Url::to(['//food/provider/view','id'=>$id]);
        $params=[
            'delete_action'=>Url::to(['//food/provider/delete','id'=>$id,'redirect'=>Url::to(['//food/provider'])]),
            'edit_action'=>Url::to(['//food/provider/edit','id'=>$id,'redirect'=>Url::to(['//food/provider/view','id'=>$id])]),
            'provider'=>$provider
        ];
        return $this->render('view',$params);
    }

    public function actionCreate()
    {
        if(\Yii::$app->request->isPost){
            $scope='Provider';//str_replace(__NAMESPACE__ . '\\', '', Provider::class);
            $provider_data=$this->request->post($scope);
            $provider=Provider::addProvider($provider_data['name'],$provider_data['is_enabled']);
            return $this->redirect(['//food/provider/edit/','id'=>$provider->id]);
        }
        return $this->render('edit-form',['provider'=>new Provider()]);
    }
    
    public function actionEdit(int $id)
    {       
        $redirect=$this->request->get('redirect');
        $get_params=[];
        if(\Yii::$app->request->isGet){
            $provider=Provider::getProvider($id);
        } else
        if(\Yii::$app->request->isPost){
            $scope='Provider';//str_replace(__NAMESPACE__ . '\\', '', Provider::class);
            $provider_data=$this->request->post($scope);
            $provider=Provider::updateProvider($id,$provider_data['name'],$provider_data['is_enabled']);
            if(!empty($redirect)){
                return $this->redirect(Url::to([$redirect]));
            }
        }
        $get_params['id']=$provider->id;
        if(!empty($redirect)){
            $get_params['redirect']=$redirect;
        }
        $form_action=Url::to(array_merge(['//food/provider/edit'],$get_params));        
        return $this->render('edit-form',['form_action'=>$form_action,'provider'=>$provider]);
    }
}