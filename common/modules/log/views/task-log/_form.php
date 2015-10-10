<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\log\models\TaskLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'log_at')->textInput() ?>

    <?= $form->field($model, 'process_id')->textInput() ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'node_id')->textInput() ?>

    <?= $form->field($model, 'action_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
