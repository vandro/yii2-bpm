<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\entity\common\models\EntityViews;
use common\modules\entity\common\models\ProcessNodes;
use common\modules\entity\common\models\Roles;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeViewRoleLink */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->node->process->title, 'url' => ['/entity/processes/view?id='.$model->node->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->node->title, 'url' => ['/entity/process-nodes/view?id='.$model->node_id.'&tab=4']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-view-role-link-view">

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
            [
                'attribute' => 'node_id',
                'value' => ProcessNodes::findOne($model['node_id'])->title,
            ],
            [
                'attribute' => 'view_id',
                'value' => EntityViews::findOne($model['view_id'])->title,
            ],
            [
                'attribute' => 'role_id',
                'value' => Roles::findOne($model['role_id'])->title,
            ],
        ],
    ]) ?>

</div>
