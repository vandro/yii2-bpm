<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\Roles;
use common\modules\entity\common\models\ProcessNodes;
use common\modules\entity\common\models\EntityViews;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeViewRoleLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-view-role-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'view_id')->dropDownList($model->allViews, ['prompt' => ' -- Выберите представление --']) ?>

    <?= $form->field($model, 'role_id')->dropDownList($model->allRoles, ['prompt' => ' -- Выберите роль --']) ?>

    <?= $form->field($model, 'settings')->textarea(['rows' => 6]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
