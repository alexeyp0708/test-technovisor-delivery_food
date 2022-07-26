<?php
/**
 * @var \App\Alpa\Food\models\Provider $provider
 * @var string $form_action
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;



?>
<h2>ID: <?=$provider->id?></h2>
<?php $form = ActiveForm::begin([
    'id' => 'provider-edit-form',
    'action'=>$form_action
]); ?>
<?php if (!is_null($provider->id)): ?>
<?=$form->field($provider,'id')->hiddenInput(['value'=>$provider->id])->label(false);?>
<?php endif;?>
<?= $form->field($provider, 'name') ?>

<?= $form->field($provider, 'is_enabled')
    ->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
