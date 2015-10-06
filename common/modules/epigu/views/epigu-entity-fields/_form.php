<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguAndEntityFieldsLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epigu-and-entity-fields-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'in_action_entity_link_id')->textInput() ?>

    <?= $form->field($model, 'epigu_service_id')->textInput() ?>

    <?= $form->field($model, 'epigu_service_field_id')->textInput() ?>

    <?= $form->field($model, 'entity_type_id')->textInput() ?>

    <?= $form->field($model, 'entity_type_fields_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
