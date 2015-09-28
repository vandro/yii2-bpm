<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\NodesConditions */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->node->process->title, 'url' => ['/entity/processes/view?id='.$model->node->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->node->title, 'url' => ['/entity/process-nodes/view?id='.$model->node_id.'&tab=5']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodes-conditions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'node_id',
            'next_execution_type',
            'true_action_id',
            'false_action_id',
            'true_condition_id',
            'false_condition_id',
            'operator',
            'operand_1_entity_id',
            'operand_1_field_id',
            'operand_2',
        ],
    ]) ?>

</div>
