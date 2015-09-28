<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeViewRoleLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Node View Role Link',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->node->process->title, 'url' => ['/entity/processes/view?id='.$model->node->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->node->title, 'url' => ['/entity/process-nodes/view?id='.$model->node_id.'&tab=4']];
$this->params['breadcrumbs'][] = ['label' => $model->view->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="node-view-role-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
