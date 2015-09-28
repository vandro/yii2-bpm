<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\entity\common\models\EntityForms;
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\ProcessNodes;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodesActions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodes-actions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_id')->dropDownList(ArrayHelper::map(EntityForms::find()->all(), 'id', 'title'), ['prompt' => ' -- Выберите форму --']) ?>

    <?= $form->field($model, 'next_node_id')->dropDownList(ArrayHelper::map(ProcessNodes::find()->all(), 'id', 'title'), ['prompt' => ' -- Выберите следующую ноду --']) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(['semiautomatic' => 'Semiautomatic', 'automatic' => 'Automatic'], ['prompt' => 'Chose node type']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
