<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityChildFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-child-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_form_id') ?>

    <?= $form->field($model, 'entity_type_id') ?>

    <?= $form->field($model, 'foreign_key_field_id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'widget') ?>

    <?php // echo $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'html') ?>

    <?php // echo $form->field($model, 'added') ?>

    <?php // echo $form->field($model, 'mode') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
