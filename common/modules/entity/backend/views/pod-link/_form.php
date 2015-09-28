<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\ProcessOrganDepartLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="process-organ-depart-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'process_id')->dropDownList($model->getAllProcess(), ['prompt' => 'Chose process']) ?>

    <?= $form->field($model, 'first_department_id')->dropDownList($model->getAllDepartments(), ['prompt' => 'Chose process']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
