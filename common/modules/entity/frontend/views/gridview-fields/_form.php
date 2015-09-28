<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\GridviewFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gridview-fields-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'gridview_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'entity_types_id')->textInput() ?>
    <?= $form->field($model, 'entity_type_id')->dropDownList($model->getAllEntityTypes(),[
        'prompt' => ' -- Choose entity type--',
        'onchange' => 'getFields(this)',
    ]) ?>

<!--    --><?//= $form->field($model, 'field_id')->textInput() ?>

    <?= $form->field($model, 'field_id')->dropDownList($model->getAllEntityTypeFields(),[
        'prompt' => ' -- Choose column--',
    ]) ?>

    <?= $form->field($model, 'condition')->dropDownList($model->getAllConditionsTypes(),[
        'prompt' => ' -- Choose condition--',
    ]) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function getFields(entity_type)
    {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: 'columns?id='+entity_type.value,
            success: function (result) {
                $('#gridviewfields-field_id option').remove();
                $('#gridviewfields-field_id').append('<option value="0">Choose column</option>');
                for (key in result) {
                    $('#gridviewfields-field_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }
</script>
