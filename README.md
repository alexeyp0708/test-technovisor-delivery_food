# food delivery app
- [тестовое задание](/docs/task.md)
- [Доска задач](https://github.com/alexeyp0708/test-technovisor-delivery_food/projects/1)

## Install

`composer config repositories.food --append vcs https://github.com/alexeyp0708/test-technovisor-delivery_food.git`  
`composer require alpa/test-technovisor-delivery_food dev-master`  

add config file 

```php
//....
    'components'=>[
    //...
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules'=>[
        //...
        'food'=>[
            'basePath'=>'@vendor/alpa/test-technovisor-delivery_food/src/food',
            'class'=>'App\\Alpa\\Food\\Module'
        ]
    ],
    'controllerMap' => [
        'migrate-food' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['App\\Alpa\\Food\\migrations'],
        ],
    ]
    // or     
   /* 'controllerMap' => [
        'migrate-modules' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                //...
                'App\\Alpa\\Food\\migrations'
            ]
        ],
    ] */
```
run command `yii migrate-food`


add config file for console

```php
    'bootstrap' => [
        // food
        'food'
    ],
    'modules'=>[
        'food'=>[
            //'basePath'=>'@vendor/alpa/test-technovisor-delivery_food/src/food',
            'class'=>'App\\Alpa\\Food\\Module'
        ]
    ],
```
To initialize the role policy
run command `php yii food/rbac/init`

assign a role to a user
run command `php yii food/rbac/assign-role {user_id} {role_name}`
Roles list:
- worker 
- food_manager
- food_provider
