<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\upload\models\TasksFilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'task_id') ?>

    <?= $form->field($model, 'node_id') ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'ext') ?>

    <?php // echo $form->field($model, 'directoryPath') ?>

    <?php // echo $form->field($model, 'urlPath') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
