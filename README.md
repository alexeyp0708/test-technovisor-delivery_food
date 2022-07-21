# food delivery app
- [тестовое задание](/docs/task.md)
- [Доска задач](https://github.com/alexeyp0708/test-technovisor-delivery_food/projects/1)

## Install

`composer config repositories.food --append vcs https://github.com/alexeyp0708/test-technovisor-delivery_food.git`  
`composer require alpa/test-technovisor-delivery_food dev-master`  

add config file 

```php
//....
    'modules'=>[
        'food'=>[
            'basePath'=>'@vendor/alpa/test-technovisor-delivery_food/src/food',
            'class'=>'App\\Alpa\\Food\\Module'
        ]
    ]
```

