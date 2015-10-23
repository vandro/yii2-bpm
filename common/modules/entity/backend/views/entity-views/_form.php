<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityViews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-views-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'parent_view_id')->dropDownList($model->getAllViews(), ['prompt' => 'Choose Parent View']); ?>

    <?= $form->field($model, 'foreign_key_field_id')->dropDownList($model->getAllEntityFields(), ['prompt' => 'Choose Foreign Key Field ID']); ?>

    <?= $form->field($model, 'settings')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'html')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
