<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\RightRoleLinks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="right-role-links-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'right_id')->dropDownList($model->getAllRights(), ['prompt' => 'Chose right']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
