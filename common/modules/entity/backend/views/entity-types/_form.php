<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'database_id')->dropDownList($model->getAllDatabases(), ['prompt' => '-- Выбрать --']); ?>

    <?= $form->field($model, 'type_id')->dropDownList($model->getAllTypes(), ['prompt' => '-- Выбрать --']); ?>

    <?=  $form->field($model, 'published')->dropDownList([0 => 'Нет', 1 => 'Да'], ['prompt' => 'Опубликовать']); ?>

    <?php if($model->added) {
        echo $form->field($model, 'added')->dropDownList([0 => 'Нет', 1 => 'Да'], ['prompt' => 'Добавить']);
    }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
