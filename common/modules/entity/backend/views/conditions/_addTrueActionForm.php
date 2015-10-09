<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\NodesConditions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodes-conditions-form">

    <?php $form = ActiveForm::begin(['id' => 'condition_form']); ?>

    <?= $form->field($model, 'true_action_id')->dropDownList($model->node->getNodeActions(), ['prompt' => 'Choose true action']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>