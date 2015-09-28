<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\NodesConditions */

$this->title = Yii::t('app', 'Create Nodes Conditions');
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->node->process->title, 'url' => ['/entity/processes/view?id='.$model->node->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->node->title, 'url' => ['/entity/process-nodes/view?id='.$model->node_id.'&tab=5']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodes-conditions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
