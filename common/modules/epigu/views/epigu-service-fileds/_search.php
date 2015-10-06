<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguServiceFiledsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epigu-service-fileds-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'epigu_service_id') ?>

    <?= $form->field($model, 'epigu_fileld_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'group') ?>

    <?php // echo $form->field($model, 'label_ru') ?>

    <?php // echo $form->field($model, 'label_uz') ?>

    <?php // echo $form->field($model, 'label_en') ?>

    <?php // echo $form->field($model, 'description_ru') ?>

    <?php // echo $form->field($model, 'description_uz') ?>

    <?php // echo $form->field($model, 'description_en') ?>

    <?php // echo $form->field($model, 'has_group') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'depend') ?>

    <?php // echo $form->field($model, 'has_dependents') ?>

    <?php // echo $form->field($model, 'is_default') ?>

    <?php // echo $form->field($model, 'disabled') ?>

    <?php // echo $form->field($model, 'defaultValue') ?>

    <?php // echo $form->field($model, 'api') ?>

    <?php // echo $form->field($model, 'validators') ?>

    <?php // echo $form->field($model, 'step') ?>

    <?php // echo $form->field($model, 'mode') ?>

    <?php // echo $form->field($model, 'inResult') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
