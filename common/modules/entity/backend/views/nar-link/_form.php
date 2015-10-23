<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\Roles;
use common\modules\entity\common\models\ProcessNodes;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeActionRoleLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-action-role-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'action_id')->dropDownList(ArrayHelper::map(NodesActions::find()->all(), 'id', 'title'), ['prompt' => ' -- Выберите действие --']) ?>

    <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Roles::find()->all(), 'id', 'title'), ['prompt' => ' -- Выберите роль --']) ?>

    <?= $form->field($model, 'next_node_id')->dropDownList(ArrayHelper::map($model->node->process->nodes, 'id', 'title'), ['prompt' => ' -- Выберите следующую ноду --']) ?>

    <?= $form->field($model, 'execution_type')->dropDownList(['semiautomatic' => 'Полуавтоматический', 'automatic' => 'Автоматический'], ['prompt' => ' -- Выберите тип исполнения действия --']) ?>

    <?= $form->field($model, 'has_file_upload')->dropDownList([0 => 'Нет', 1 => 'Да'], ['prompt' => ' -- Выберите --']) ?>

    <?= $form->field($model, 'settings')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
