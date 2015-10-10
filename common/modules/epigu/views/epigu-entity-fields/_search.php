<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguAndEntityFieldsLinkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epigu-and-entity-fields-link-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'in_action_entity_link_id') ?>

    <?= $form->field($model, 'epigu_service_id') ?>

    <?= $form->field($model, 'epigu_service_field_id') ?>

    <?= $form->field($model, 'entity_type_id') ?>

    <?php // echo $form->field($model, 'entity_type_fields_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
