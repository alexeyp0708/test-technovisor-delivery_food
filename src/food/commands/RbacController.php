<?php


namespace App\Alpa\Food\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        // create roles
        $foodProvider=$auth->createRole('food_provider');
        $auth->add($foodProvider);

        $foodManager=$auth->createRole('food_manager');
        $auth->add($foodManager);

        $worker=$auth->createRole('worker');
        $auth->add($worker);
        
        // create global permissions
        
        $providerAccess = $auth->createPermission('food_provider_access');
        $auth->add($providerAccess);
        
        $menuAccess = $auth->createPermission('food_menu_access');
        $auth->add($menuAccess);

        $orderAccess = $auth->createPermission('food_order_access');
        $auth->add($orderAccess);

        // create local permissions
        $createProvider=$auth->createPermission('food_provider_create');
        $auth->add($createProvider);
        $auth->addChild($providerAccess, $createProvider);
        $updateProvider=$auth->createPermission('food_provider_update');
        $auth->add($updateProvider);
        $auth->addChild($providerAccess, $updateProvider);
        $deleteProvider=$auth->createPermission('food_provider_delete');
        $auth->add($deleteProvider);
        $auth->addChild($providerAccess, $deleteProvider);
        $readProvider=$auth->createPermission('food_provider_read');
        $auth->add($readProvider);
        $auth->addChild($providerAccess, $readProvider);
        
        $createMenu=$auth->createPermission('food_menu_create');
        $auth->add($createMenu);
        $auth->addChild($menuAccess, $createMenu);
        $updateMenu=$auth->createPermission('food_menu_update');
        $auth->add($updateMenu);
        $auth->addChild($menuAccess, $updateMenu);
        $deleteMenu=$auth->createPermission('food_menu_delete');
        $auth->add($deleteMenu);
        $auth->addChild($menuAccess, $deleteMenu);
        $readMenu=$auth->createPermission('food_menu_read');
        $auth->add($readMenu);
        $auth->addChild($menuAccess, $readMenu);

        $createOrder=$auth->createPermission('food_order_create');
        $auth->add($createOrder);
        //$auth->addChild($orderAccess, $createOrder);
        $updateOrder=$auth->createPermission('food_order_update');
        $auth->add($updateOrder);
        $auth->addChild($orderAccess, $updateOrder);
        $readOrder=$auth->createPermission('food_order_read');
        $auth->add($readOrder);
        $auth->addChild($orderAccess, $readOrder);
        
        //  assigning permissions
        
        $auth->addChild($foodManager, $foodProvider);
        $auth->addChild($foodManager, $worker);
        
        $auth->addChild($foodProvider, $providerAccess);
        $auth->addChild($foodProvider, $menuAccess);
        $auth->addChild($foodProvider, $readOrder);


        $auth->addChild($worker, $orderAccess);
        $auth->addChild($worker, $createOrder);
        $auth->addChild($worker, $readProvider);
        $auth->addChild($worker, $readMenu);
        return true;
    }
    public function actionAssignRole($user_id,$permission)
    {
        $auth = Yii::$app->authManager;
        $role=$auth->getRole($permission);
        $auth->assign($role, $user_id);
        return true;
    }
}