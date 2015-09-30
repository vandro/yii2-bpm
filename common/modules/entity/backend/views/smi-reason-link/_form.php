<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestResonLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-reest-reson-link-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'smi_reason_id')->textInput() ?>
    <?= $form->field($model, 'smi_reason_id')->dropDownList($model->getAllReasons(),   ['prompt' => ' -- ОАВнинг фалият куриниши --' ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
