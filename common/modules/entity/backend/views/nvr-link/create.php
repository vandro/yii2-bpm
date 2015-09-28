<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeViewRoleLink */

$this->title = Yii::t('app', 'Create Node View Role Link');
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->node->process->title, 'url' => ['/entity/processes/view?id='.$model->node->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->node->title, 'url' => ['/entity/process-nodes/view?id='.$model->node_id.'&tab=4']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-view-role-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
