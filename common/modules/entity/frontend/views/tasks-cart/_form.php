<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\TasksCart */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="panel-body">
        <?= $form->field($model, 'organisation_id')->dropDownList($model->getAllOrganizations(), ['prompt' => 'Chose organization'])->label('Organisation'); ?>
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-default']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>


