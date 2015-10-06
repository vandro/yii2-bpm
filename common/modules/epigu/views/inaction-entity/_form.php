<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\InActionEntityLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-action-entity-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entity_type_id')->dropDownList($model->getAllEntityType(), ['prompt' => 'Выбрать'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
