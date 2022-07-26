<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \App\Alpa\Food\models\Provider[] $providers_list;
 * @var string $menu_action;
 * @var string $orders_action;
 * @var string $view_action;
 * @var string $edit_action;
 * @var string $delete_action;
 * @var string $create_action;
 * @var bool $referrer_redirect;
 */
?>
    <button onclick="location.href='<?=$create_action;?>'" type="button">Add Provider</button>
    <table style="text-align:center">
        <thead>
        <tr >
            <td>ID</td>
            <td>Name</td>
            <td>Enabled</td>
            <td>Action</td>
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
                    <input type="button" value="Menu" onclick="location.href='<?=Url::to([$menu_action,'provider_id'=>$provider->id]);?>'"/>
                    <?php  if (\Yii::$app->user->can('food_provider') ):?>
                    <input type="button" value="Orders" onclick="location.href='<?=Url::to([$orders_action,'provider_id'=>$provider->id]);?>'"/>
                    <?php endif;?>
                    <input type="button" value="View" onclick="location.href='<?=Url::to([$view_action,'id'=>$provider->id]);?>'"/>
                    <?php  if (\Yii::$app->user->can('food_provider') ):?>
                    <input type="button" value="Edit" onclick="location.href='<?=Url::to([$edit_action,'id'=>$provider->id]);?>'"/>
                    <input type="button" value="Delete" onclick="location.href='<?=Url::to([$delete_action,'id'=>$provider->id]);?>'"/>
                    <?php  endif;?>
                </td> 
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

<?= Html::encode('');?>