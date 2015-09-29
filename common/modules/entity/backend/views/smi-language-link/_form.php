<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiLanguageLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-language-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'language_id')->dropDownList($model->getAllLanguage(),   ['prompt' => ' -- Тилни танланг--' ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
