<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessNodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="process-nodes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'order_status')->dropDownList(['first' => 'First Node', 'first_process' => 'First Process Node', 'process' => 'Process Node', 'last' => 'Last Node'], ['prompt' => 'Chose node order in process']) ?>

    <?= $form->field($model, 'execution_type')->dropDownList(['semiautomatic' => 'Semiautomatic', 'automatic' => 'Automatic'], ['prompt' => 'Chose node type']) ?>

    <?= $form->field($model, 'process_id')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
