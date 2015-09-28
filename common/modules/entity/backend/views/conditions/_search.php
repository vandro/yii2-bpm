<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\NodesConditionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodes-conditions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'node_id') ?>

    <?= $form->field($model, 'next_execution_type') ?>

    <?= $form->field($model, 'true_action_id') ?>

    <?= $form->field($model, 'false_action_id') ?>

    <?php // echo $form->field($model, 'true_condition_id') ?>

    <?php // echo $form->field($model, 'false_condition_id') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'operand_1_entity_id') ?>

    <?php // echo $form->field($model, 'operand_1_field_id') ?>

    <?php // echo $form->field($model, 'operand_2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
