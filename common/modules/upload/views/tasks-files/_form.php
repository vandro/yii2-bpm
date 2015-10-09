<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\upload\models\TasksFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'node_id')->textInput() ?>

    <?= $form->field($model, 'action_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'directoryPath')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'urlPath')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
