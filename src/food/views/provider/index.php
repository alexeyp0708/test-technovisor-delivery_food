<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \App\Alpa\Food\models\Provider[] $providers_list;
 * @var \App\Alpa\helpers\RoutesHelper\RoutesCollection[]|ArrayObject $routes
 * 
 */
?>
    <button onclick="location.href='<?=$routes->provider->create;?>'" type="button">Add Provider</button>
    <table style="text-align:center">
        <thead>
        <tr >
            <td>ID</td>
            <td>Name</td>
            <td>Enabled</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($providers_list as $provider):
            //$provider=(object)$provider;
            ?>
            <tr>
                <td><?=$provider->id;?></td>
                <td><?=Html::encode($provider->name);?></td>
                <td> <?=$provider->is_enabled?"&#10003; ":'';?></td>
                <td>
                    <input type="button" value="Menu" onclick="location.href='<?=$routes->menu->index(['provider_id'=>$provider->id]);?>'"/>
                    <?php  if (\Yii::$app->user->can('food_provider') ):?>
                    <input type="button" value="Orders" onclick="location.href='<?=$routes->menu->index(['provider_id'=>$provider->id]);?>'"/>
                    <?php endif;?>
                    <input type="button" value="View" onclick="location.href='<?=$routes->provider->view(['id'=>$provider->id]);?>'"/>
                    <?php  if (\Yii::$app->user->can('food_provider') ):?>
                    <input type="button" value="Edit" onclick="location.href='<?=$routes->provider->edit(['id'=>$provider->id]);?>'"/>
                    <input type="button" value="Delete" 
                           onclick="if(window.confirm('Are you going to delete the resource ID:<?=$provider->id;?>?')){fetch('<?=$routes->provider->delete(['id'=>$provider->id]);?>',{method:'delete',headers:{'X-CSRF-Token':'<?=Yii::$app->request->getCsrfToken()?>'}}).then(()=>{location.href='<?=$routes->provider->index?>';});}"/>
                    <?php  endif;?>
                </td> 
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

<?= Html::encode('');?>