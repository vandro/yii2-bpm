<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguServiceFileds */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epigu-service-fileds-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'epigu_service_id')->textInput() ?>

    <?= $form->field($model, 'epigu_fileld_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'group')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'label_ru')->textInput() ?>

    <?= $form->field($model, 'label_uz')->textInput() ?>

    <?= $form->field($model, 'label_en')->textInput() ?>

    <?= $form->field($model, 'description_ru')->textInput() ?>

    <?= $form->field($model, 'description_uz')->textInput() ?>

    <?= $form->field($model, 'description_en')->textInput() ?>

    <?= $form->field($model, 'has_group')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'depend')->textInput() ?>

    <?= $form->field($model, 'has_dependents')->textInput() ?>

    <?= $form->field($model, 'is_default')->textInput() ?>

    <?= $form->field($model, 'disabled')->textInput() ?>

    <?= $form->field($model, 'defaultValue')->textInput() ?>

    <?= $form->field($model, 'api')->textInput() ?>

    <?= $form->field($model, 'validators')->textInput() ?>

    <?= $form->field($model, 'step')->textInput() ?>

    <?= $form->field($model, 'mode')->textInput() ?>

    <?= $form->field($model, 'inResult')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
