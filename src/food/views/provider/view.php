<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \App\Alpa\Food\models\Provider $provider;
 * @var string $delete_action;
 * @var string $edit_action;
 */

?>

<?php  if (\Yii::$app->user->can('food_provider')):?>
    <input type="button" value="Edit" onclick="location.href='<?=$edit_action;?>'"/>
    <input type="button" value="Delete" onclick="location.href='<?=$delete_action;?>'"/>
<?php  endif;?>
<h2>
    <p>ID: <?=$provider->id?></p>
    <p>Name: <?=$provider->name?></p>
    <p>Status: <?=$provider->is_enabled?'Enabled':'Disabled'?></p>
</h2>