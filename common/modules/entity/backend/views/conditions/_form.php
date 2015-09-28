<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\NodesConditions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodes-conditions-form">

    <?php $form = ActiveForm::begin(['id' => 'condition_form']); ?>


    <?= $form->field($model, 'operator')->dropDownList(
        [
            'equal' => 'Equal (operand_1 == operand_2)',
            'identical' => 'Identical (operand_1 === operand_2)',
            'not_equal' => 'Not equal (operand_1 != operand_2)',
            'not_identical' => 'Not identical (operand_1 !== operand_2)',
            'greater_than' => 'Greater than (operand_1 > operand_2)',
            'less_than' => 'Less than (operand_1 < operand_2)',
            'greater_than_or_equal_to' => 'Greater than or equal to (operand_1 >= operand_2)',
            'less_than_or_equal_to' => 'Less than or equal to (operand_1 <= operand_2)',
        ],
        [
            'prompt' => 'Chose operator'
        ]
    ) ?>

    <?= $form->field($model, 'operand_1_entity_id')->dropDownList($model->getAllEntityTypes(), ['prompt' => 'Choose entity type', 'onchange' => 'getFields(this)']) ?>

    <?= $form->field($model, 'operand_1_field_id')->dropDownList($model->getEntityTypeFields(), ['prompt' => 'Choose field']) ?>

    <?= $form->field($model, 'operand_2')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    function showNextExecutionType(next_execution_type){
        if(next_execution_type.value == 'action'){
            $('.field-nodesconditions-true_action_id').show();
            $('.field-nodesconditions-false_action_id').show();
            $('.field-nodesconditions-true_condition_id').hide();
            $('.field-nodesconditions-false_condition_id').hide();
        }else{
            $('.field-nodesconditions-true_action_id').hide();
            $('.field-nodesconditions-false_action_id').hide();
            $('.field-nodesconditions-true_condition_id').show();
            $('.field-nodesconditions-false_condition_id').show();

        }
    }

    window.onload = function(){
        $('.field-nodesconditions-true_action_id').hide();
        $('.field-nodesconditions-false_action_id').hide();
        $('.field-nodesconditions-true_condition_id').hide();
        $('.field-nodesconditions-false_condition_id').hide();
        var next_execution_type = document.getElementById("nodesconditions-next_execution_type")
        if(next_execution_type.value == 'action'){
            $('.field-nodesconditions-true_action_id').show();
            $('.field-nodesconditions-false_action_id').show();
        }else{
            $('.field-nodesconditions-true_condition_id').show();
            $('.field-nodesconditions-false_condition_id').show();

        }

    };

    function getFields(entity_type)
    {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '<?=Yii::$app->getUrlManager()->createUrl(['entity/conditions/fields']);?>?id='+entity_type.value,
            success: function (result) {
//                var x = document.getElementById("nodesconditions-operand_1_field_id");
//                if (x.length > 0) {
//                    x.remove(x.length-1);
//                }
                $('#nodesconditions-operand_1_field_id option').remove();
                $('#nodesconditions-operand_1_field_id').append('<option value="0">Choose field</option>');
                for (key in result) {
                    $('#nodesconditions-operand_1_field_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }
</script>