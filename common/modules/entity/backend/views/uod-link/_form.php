<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\entity\common\models\User;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\UserOrganDepartLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-organ-depart-link-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'organisation_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'organisation_id')->dropDownList(User::getAllOrganizations(), ['prompt' => 'Chose organization','onchange' => "getDepartments(this)"]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(User::getAllDepartments(), ['prompt' => 'Chose department']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function getDepartments(organization)
    {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '<?=Yii::$app->urlManager->createUrl('entity/user/departments')?>?id='+organization.value,
            success: function (result) {
                $('#userorgandepartlink-department_id option').remove();
                $('#userorgandepartlink-department_id').append('<option value="0">Chose department</option>');
                for (key in result) {
                    $('#userorgandepartlink-department_id').append('<option value="' + result[key].value + '">' + result[key].label + '</option>');
                }
            }
        });
    }
</script>
