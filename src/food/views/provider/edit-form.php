<?php
/**
 * @var \App\Alpa\Food\models\Provider $provider
 * @var \App\Alpa\helpers\RoutesHelper\RoutesCollection $routes
 * @var string $method
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h2>ID: <?=$provider->id?></h2>
<?php $form = ActiveForm::begin([
    'id' => 'provider-edit-form',
    'action'=>is_null($provider->id)?$routes->provider->create:$routes->provider->edit,
    'method'=>$method??'post'
]); ?>
<?php if (!is_null($provider->id)): ?>
<?=$form->field($provider,'id')->hiddenInput(['value'=>$provider->id])->label(false);?>
<?php endif;?>
<?= $form->field($provider, 'name') ?>

<?= $form->field($provider, 'is_enabled')
    ->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    <input type="button" value="Delete"
           onclick="if(window.confirm('Are you going to delete the resource ID:<?=$provider->id;?>?')){fetch('<?=$routes->provider->delete(['id'=>$provider->id]);?>',{method:'delete',headers:{'X-CSRF-Token':'<?=Yii::$app->request->getCsrfToken()?>'}}).then(()=>{location.href='<?=$routes->provider->index?>';});}"/>
</div>

<?php ActiveForm::end(); ?>
