<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguAndEntityFieldsLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epigu-and-entity-fields-link-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'in_action_entity_link_id')->textInput() ?>

    <?= $form->field($model, 'epigu_service_id')->dropDownList($model->getAllEpiguServices(), ['prompt' => 'Выбрать', 'onchange' => "getEpiguServiceFields(this)"]) ?>

    <?= $form->field($model, 'epigu_service_field_id')->dropDownList($model->getAllEpiguServicesFields(), ['prompt' => 'Выбрать']) ?>

    <?= $form->field($model, 'entity_type_id')->dropDownList($model->getAllEntityType(), ['prompt' => 'Выбрать', 'onchange' => "getEntityTypeFields(this)"]) ?>

    <?= $form->field($model, 'entity_type_fields_id')->dropDownList($model->getAllEntityTypeFields(), ['prompt' => 'Выбрать']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function getEpiguServiceFields(service)
    {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '<?=Yii::$app->urlManager->createUrl('epigu/epigu-entity-fields/epigu-service-fields')?>?id='+service.value,
            success: function (result) {
                $('#epiguandentityfieldslink-epigu_service_field_id option').remove();
                $('#epiguandentityfieldslink-epigu_service_field_id').append('<option value="0">Chose department</option>');
                for (key in result) {
                    $('#epiguandentityfieldslink-epigu_service_field_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }

    function getEntityTypeFields(entityType)
    {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '<?=Yii::$app->urlManager->createUrl('epigu/epigu-entity-fields/entity-fields')?>?id='+entityType.value,
            success: function (result) {
                $('#epiguandentityfieldslink-entity_type_fields_id option').remove();
                $('#epiguandentityfieldslink-entity_type_fields_id').append('<option value="0">Chose department</option>');
                for (key in result) {
                    $('#epiguandentityfieldslink-entity_type_fields_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }
</script>
