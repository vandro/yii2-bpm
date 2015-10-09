<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smi-reestr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kind_id')->dropDownList($model->getAllKinds(),   ['prompt' => ' -- ОАВнинг фалият куриниши --' ]) ?>

    <?= $form->field($model, 'type_id')->dropDownList($model->getAllTypes(),   ['prompt' => ' -- ОАВнинг турини танланг --' ]) ?>

    <?= $form->field($model, 'national')->dropDownList([0 => 'нодавлат', 1 => 'давлат'],   ['prompt' => ' -- ОАВнинг қарашли бўлгани --' ]) ?>

    <?= $form->field($model, 'begin_at')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList([0 => 'тугатилган', 1 => 'очилган' ], ['prompt' => '-- ОАВнинг холати --']) ?>

    <?= $form->field($model, 'frequency_period')->dropDownList([ 'day' => 'Кун', 'week' => 'Ҳафта', 'month' => 'Ой', 'year' => 'Йил', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'frequency_times')->textInput() ?>

    <?= $form->field($model, 'distribution_type_id')->dropDownList($model->getAllDistributionType(),   ['prompt' => ' -- Тарқатиш усули --']) ?>

    <?= $form->field($model, 'region_id')->dropDownList($model->getAllRegions(),   ['prompt' => ' -- Ҳудуд танланг--','onchange' => "getCities(this)" ]) ?>

    <?= $form->field($model, 'city_id')->dropDownList($model->getAllCities(),   ['prompt' => ' -- Шахар танланг--' ]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chief_editor_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'certificate_number')->textInput(['maxlength' => true]) ?>

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
                $('#smireestr-city_id option').remove();
                $('#smireestr-city_id').append('<option value="0">-- Шахар танланг--</option>');
                for (key in result) {
                    $('#smireestr-city_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }
</script>
