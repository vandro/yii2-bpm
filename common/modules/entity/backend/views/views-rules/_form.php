<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\entity\common\models\EntityFields;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ViewsRules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="views-rules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'field_id')->dropDownList(ArrayHelper::map(EntityFields::find()->where(['entity_id' => $model->view->entity_id])->all(), 'id', 'title'), ['prompt' => ' -- Выберите полe --']) ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'view_id')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
