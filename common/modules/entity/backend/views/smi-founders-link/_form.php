<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiFoundersLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-founders-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'smi_founders_id')->dropDownList($model->getAllFounders(),   ['prompt' => ' -- Муассиси танланг--' ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
