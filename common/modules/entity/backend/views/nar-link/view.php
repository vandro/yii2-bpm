<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\entity\common\models\ProcessNodes;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\Roles;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeActionRoleLink */

$this->title = 'Action Link: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->node->process->title, 'url' => ['/entity/processes/view?id='.$model->node->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->node->title, 'url' => ['/entity/process-nodes/view?id='.$model->node_id.'&tab=3']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-action-role-link-view">

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

<?= Tabs::widget([
        'items' => [
            [
                'label' => 'Action',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'node_id',
                            'value' => ProcessNodes::findOne($model['node_id'])->title,
                        ],
                        [
                            'attribute' => 'action_id',
                            'value' => NodesActions::findOne($model['action_id'])->title,
                        ],
                        [
                            'attribute' => 'role_id',
                            'value' => Roles::findOne($model['role_id'])->title,
                        ],
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Handlers',
                'content' => $this->render('_handlersIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
        ],
])?>

</div>
