<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-reestr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList($model->getAllTypes(),   ['prompt' => ' -- OAV турини танланг--' ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'begin_at')->textInput() ?>

    <?= $form->field($model, 'frequency_period')->dropDownList([ 'day' => 'Кун', 'week' => 'Ҳафта', 'month' => 'Ой', 'year' => 'Йил', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'frequency_times')->textInput() ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chief_editor_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'certificate_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
