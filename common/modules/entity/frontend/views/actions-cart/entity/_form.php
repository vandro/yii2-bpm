<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 07.09.2015
 * Time: 11:22
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\upload\widgets\MegaFileUploadWidget;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypes */
/* @var $form yii\widgets\ActiveForm */
?>


    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
            <?= $formModel->render($form, $entity) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="panel-body">
        <?= MegaFileUploadWidget::widget() ?>
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?= Html::submitButton('Create' , ['class' => 'btn btn-default']) ?>
        </div>
    </div>



