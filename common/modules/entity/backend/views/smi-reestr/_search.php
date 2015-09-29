<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestrSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-reestr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'begin_at') ?>

    <?= $form->field($model, 'frequency_period') ?>

    <?php // echo $form->field($model, 'frequency_times') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'chief_editor_full_name') ?>

    <?php // echo $form->field($model, 'phones') ?>

    <?php // echo $form->field($model, 'certificate_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
