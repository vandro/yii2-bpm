<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiDistributionRegion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-distribution-region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_id')->dropDownList($model->getAllRegions(),   ['prompt' => ' -- Ҳудуд танланг--','onchange' => "getCities(this)" ]) ?>

    <?= $form->field($model, 'city_id')->dropDownList($model->getAllCities(),   ['prompt' => ' -- Шахар танланг--' ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function getCities(region)
    {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '<?=Yii::$app->urlManager->createUrl('entity/smi-reestr/cities')?>?id='+region.value,
            success: function (result) {
                $('#smidistributionregion-city_id option').remove();
                $('#smidistributionregion-city_id').append('<option value="0">-- Шахар танланг--</option>');
                for (key in result) {
                    $('#smidistributionregion-city_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }
</script>
