<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \App\Alpa\Food\models\Provider $provider;
 * @var \App\Alpa\helpers\RoutesHelper\RoutesCollection $routes;
 */

?>

<input type="button" value="Menu" onclick="location.href='<?=$routes->menu->index;?>'"/>
<?php  if (\Yii::$app->user->can('food_provider')):?>
    <input type="button" value="Orders" onclick="location.href='<?=$routes->order->index;?>'"/>
    <input type="button" value="Edit" onclick="location.href='<?=$routes->provider->edit;?>'"/>
    <input type="button" value="Delete"
           onclick="if(window.confirm('Are you going to delete the resource ID:<?=$provider->id;?>?')){fetch('<?=$routes->provider->delete(['id'=>$provider->id]);?>',{method:'delete',headers:{'X-CSRF-Token':'<?=Yii::$app->request->getCsrfToken()?>'}}).then(()=>{location.href='<?=$routes->provider->index?>';});}"/>
<?php  endif;?>
<h2>
    <p>ID: <?=$provider->id?></p>
    <p>Name: <?=$provider->name?></p>
    <p>Status: <?=$provider->is_enabled?'Enabled':'Disabled'?></p>
</h2>