<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var string $message
 */
?>
    <button onclick="location.href='<?=Url::to(['//food/provider']);?>'" type="button">Providers</button>
    <button onclick="location.href='<?=Url::to(['//food/menu']);?>'" type="button">Menu</button>
    <button onclick="location.href='<?=Url::to(['//food/order']);?>'" type="button">Orders</button>
    
<?= Html::encode($message);?>