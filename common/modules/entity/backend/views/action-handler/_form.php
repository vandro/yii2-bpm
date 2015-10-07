<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ActionHandlerLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-handler-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'handler_id')->dropDownList($model->getAllHandlers(),['prompt' => '-- Выбрать --']) ?>

    <?= $form->field($model, 'type')->dropDownList(['usual' => 'Стандартный', 'integration' => 'Интеграционный' ],['prompt' => '-- Выбрать --']) ?>

    <?= $form->field($model, 'settings')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
